<?php
namespace App\Http\Controllers\Companies;

use App\Models\Scouters;
use App\Models\Companies;
use App\Models\Users;
use App\Models\Jobs;
use App\Models\Applies;
use App\Models\Candidates;
use App\Models\Jobstatus;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

/**
 * 
 */
class CandidatesController extends Controller
{
	/**
     * Description: show all candidates
     * @author: Do.Truong
     * @version: V1
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request){

	    $user = Auth::user();

	    $jobStatus = Jobstatus::all();

	    try {

            $jobName = $request->jobname;
            $scouterName = $request->scoutername;

            $jobs = DB::table('jobs')
                ->join('companies', 'jobs.company_id', '=', 'companies.id')
                ->select('jobs.name as jobName',
                    'jobs.id as jobId'
                )
                ->where('jobs.delete_flg', 0)
                ->where('companies.member_id', $user->id)
                ->get();

            $query = DB::table('jobs')
                ->join('applies', 'jobs.id', '=', 'applies.job_id')
                ->join('companies', 'companies.id', '=', 'jobs.company_id')
                ->join('candidates', 'candidates.id', '=', 'applies.candidate_id')
                ->join('jobstatus', 'applies.jobstatus_id', '=', 'jobstatus.id')
                ->join('scouters', 'applies.scouter_id', '=', 'scouters.id')
                ->join('users', 'scouters.member_id', '=', 'users.id')
                ->select('candidates.name as candidateName',
                    'candidates.email as candidatesEmail',
                    'applies.id as applyId',
                    'applies.cv_url as cvUrl',
                    'applies.message as message',
                    'applies.created as created',
                    'applies.company_note as companyNote',
                    'jobstatus.name as jobStatus',
                    'users.name as scouterName'
                )
                ->where('applies.delete_flg', 0)
                ->where('candidates.delete_flg', 0)
                ->where('companies.member_id', $user->id);

            if ($jobName){
                $query->where('jobs.name', $jobName);
            }

            if ($scouterName){
                $query->where('users.name', $scouterName);
            }
            $applies = $query->paginate(10);

            return view('front/companies.candidateindex', compact('applies', 'jobStatus', 'jobs', 'user', $applies, $jobStatus, $jobs, $user));

        } catch (Exception $e) {
            return redirect()->action('Companies\CandidatesController@index')->with('message',$e);
        }
	}

    /**
     * Description: update company note to applies table
     * @author: Do.Truong
     * @version: V1
     * @return: status data
     */
	public function updateNoteAjax(Request $request){
        $requestData = $request->all();
        $allData = json_decode($requestData['data'], true);
        $applyId = $allData['applyId'];
        $note = $allData['note'];
        if (!empty($applyId)){
            try{
                DB::beginTransaction();
                try{
                    DB::table('applies')
                        ->where('id', $applyId)
                        ->update([
                            'company_note' => $note
                        ]);
                    DB::commit();
                    $returnData = [
                        'status' => 'success',
                        'data' => null
                    ];
                    return json_encode($returnData);
                } catch (Exception $e) {
                    DB::rollBack();
                    $errProcess = [
                        'error' => $e
                    ];
                    return json_encode($errProcess);
                }
            } catch (Exception $e) {
                $errTransaction = [
                    'error' => $e
                ];
                return json_encode($errTransaction);
            }
        } else {
            return false;
        }
	}

    /**
     * Description: update job status to applies table
     * @author: Do.Truong
     * @version: V1
     * @return: status data
     */

    public function updateStatusAjax(Request $request){
        $requestData = $request->all();
        $allData = json_decode($requestData['data'], true);
        $applyId = $allData['applyId'];
        $statusId = $allData['statusId'];
        if (!empty($applyId)){
            try{
                DB::beginTransaction();
                try{
                    DB::table('applies')
                        ->where('id', $applyId)
                        ->update([
                            'jobstatus_id' => $statusId
                        ]);
                    DB::commit();
                    $returnData = [
                        'status' => 'success',
                        'data' => null
                    ];
                    return json_encode($returnData);
                } catch (Exception $e) {
                    DB::rollBack();
                    $errProcess = [
                        'error' => $e
                    ];
                    return json_encode($errProcess);
                }
            } catch (Exception $e) {
                $errTransaction = [
                    'error' => $e
                ];
                return json_encode($errTransaction);
            }
        } else {
            return false;
        }
    }

    /**
     * Description: delete candidate
     * @author: Do.Truong
     * @version: V1
     * @return: status data
     */
    public function deleteCandidateAjax(Request $request){
        $requestData = $request->all();
        $applyId = $requestData['data'];
        if (!empty($applyId)){
            try{
                DB::beginTransaction();
                try{
                    DB::table('applies')
                        ->where('id', $applyId)
                        ->update([
                            'delete_flg' => 1
                        ]);
                    DB::commit();
                    $returnData = [
                        'status' => 'success',
                        'data' => null
                    ];
                    return json_encode($returnData);
                } catch (Exception $e) {
                    DB::rollBack();
                    $errProcess = [
                        'error' => $e
                    ];
                    return json_encode($errProcess);
                }
            } catch (Exception $e) {
                $errTransaction = [
                    'error' => $e
                ];
                return json_encode($errTransaction);
            }
        } else {
            return false;
        }
    }

    /**
     * Description: Search candidate
     * @author: Do.Truong
     * @version: V1
     * @return: \Illuminate\Http\Response
     */
    public function searchCandidate(Request $request){
        $user = Auth::user();

        $jobStatus = Jobstatus::all();

        $jobs = DB::table('jobs')
            ->join('companies', 'jobs.company_id', '=', 'companies.id')
            ->select('jobs.name as jobName',
                'jobs.id as jobId'
            )
            ->where('jobs.delete_flg', 0)
            ->where('companies.member_id', $user->id)
            ->get();

        $jobName = $request->jobname;

        $jobStatusId = Input::get('jobStatusId');
        $jobNameId = Input::get('jobNameId');
        $sort = Input::get('sort');

        try {
            $query = DB::table('jobs')
                ->join('applies', 'jobs.id', '=', 'applies.job_id')
                ->join('companies', 'companies.id', '=', 'jobs.company_id')
                ->join('candidates', 'candidates.id', '=', 'applies.candidate_id')
                ->join('jobstatus', 'applies.jobstatus_id', '=', 'jobstatus.id')
                ->join('scouters', 'applies.scouter_id', '=', 'scouters.id')
                ->join('users', 'scouters.member_id', '=', 'users.id')
                ->select('candidates.name as candidateName',
                    'candidates.email as candidatesEmail',
                    'applies.id as applyId',
                    'applies.cv_url as cvUrl',
                    'applies.message as message',
                    'applies.created as created',
                    'applies.company_note as companyNote',
                    'jobstatus.name as jobStatus',
                    'users.name as scouterName'
                )
                ->where('applies.delete_flg', 0)
                ->where('candidates.delete_flg', 0)
                ->where('companies.member_id', $user->id)
                ->where(function ($query) use ($jobName){
                    if ($jobName){
                        $query->where('jobs.name', $jobName);
                    }
                });

            $is_first = false;

            if ($jobStatusId != "") {
                if($is_first)
                {
                    $query->where('applies.jobstatus_id', $jobStatusId);
                }else{
                    $is_first = true;
                    $query->where('applies.jobstatus_id', $jobStatusId);
                }
            }

            if ($jobNameId != "") {
                if($is_first)
                {
                    $query->where('applies.job_id', $jobNameId);
                }else{
                    $is_first = true;
                    $query->where('applies.job_id', $jobNameId);
                }
            }

            if ($sort != "") {
                if ($sort == "timeASC"){
                    if($is_first)
                    {
                        $query->orderBy('applies.created', 'asc');
                    }else{
                        $is_first = true;
                        $query->orderBy('applies.created', 'asc');
                    }
                } else {
                    if($is_first)
                    {
                        $query->orderBy('candidates.name', 'asc');
                    }else{
                        $is_first = true;
                        $query->orderBy('candidates.name', 'asc');
                    }
                }
            }

            $applies = $query->get();

            if (count($applies) >= 0){
                $mess_success = config('master.MESSAGE_NOTIFICATION.MSG_105');
                return view('front/companies.candidatesearch', compact('applies', 'jobStatus', 'jobs', 'user', $applies, $jobStatus, $jobs, $user))->with('message',$mess_success);
            } else {
                $mess_not_result = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_203');
                return redirect()->action('Companies\CandidatesController@searchCandidate')->with('message',$mess_not_result);
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}