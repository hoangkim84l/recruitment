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
class JobsController extends Controller
{
    /**
     * Description: show all jobs
     * @author: Do.Truong
     * @version: V1
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $user = Auth::user();
        try {
            $jobs = DB::table('jobs')
                ->join(DB::raw('(SELECT id FROM companies WHERE member_id='. $user->id .') as comp'),
                    'jobs.company_id', '=', 'comp.id')
                ->leftJoin(DB::raw('(SELECT id, job_id FROM applies WHERE delete_flg = 0) as a'),
                    'jobs.id', '=', 'a.job_id')
                ->groupBy('a.job_id', 'jobs.name', 'jobs.created', 'jobs.expire_date', 'jobs.id')
                ->select('jobs.name as jobTitle',
                    'jobs.created as datePosted',
                    'jobs.expire_date as dateExpire',
                    'jobs.id as jobId',
                    DB::raw('count(a.id) as countApply')
                )
                ->where('jobs.delete_flg', 0)
                ->paginate(10);

            return view('front/companies.jobindex', compact('jobs', 'user', $jobs, $user));
        } catch (Exception $e){
            return redirect()->action('Companies\JobsController@index')->with('message',$e);
        }
    }

    /**
     * Description: delete job
     * @author: Do.Truong
     * @version: V1
     * @return: status data
     */
    public function deleteJobAjax(Request $request){
        $requestData = $request->all();
        $jobId = $requestData['data'];
        if (!empty($jobId)){
            try{
                DB::beginTransaction();
                try{
                    DB::table('jobs')
                        ->where('id', $jobId)
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
     * Description: delete multi job
     * @author: Do.Truong
     * @version: V1
     * @return: status data
     */

    public function deleteMultiJobAjax(Request $request){
        $requestData = $request->all();
        $arrId = $requestData['data'];
        try{
            DB::beginTransaction();
            try{
                DB::table('jobs')
                    ->whereIn('id', $arrId)
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
    }

    /**
     * Description: Search job
     * @author: Do.Truong
     * @version: V1
     * @return: \Illuminate\Http\Response
     */
    public function searchJob(){
        $user = Auth::user();

        $jobNameSearch = Input::get('jobNameSearch');

        try {
            $query = DB::table('jobs')
                ->join(DB::raw('(SELECT id FROM companies WHERE member_id='. $user->id .') as comp'),
                    'jobs.company_id', '=', 'comp.id')
                ->leftJoin(DB::raw('(SELECT id, job_id FROM applies WHERE delete_flg = 0) as a'),
                    'jobs.id', '=', 'a.job_id')
                ->groupBy('a.job_id', 'jobs.name', 'jobs.created', 'jobs.expire_date', 'jobs.id')
                ->select('jobs.name as jobTitle',
                    'jobs.created as datePosted',
                    'jobs.expire_date as dateExpire',
                    'jobs.id as jobId',
                    DB::raw('count(a.id) as countApply')
                )
                ->where('jobs.delete_flg', 0);

            $is_first = false;
            if ($jobNameSearch != "") {
                if($is_first)
                {
                    $query->orWhere('jobs.name','LIKE','%'.$jobNameSearch.'%');
                }else{
                    $is_first = true;
                    $query->where('jobs.name','LIKE','%'.$jobNameSearch.'%');
                }
            }

            $jobs = $query->get();

            if (count($jobs) >= 0){
                $mess_success = config('master.MESSAGE_NOTIFICATION.MSG_105');
                return view('front/companies.jobsearch', compact('jobs', 'user', $jobs, $user))
                    ->with('message',$mess_success);
            } else {
                $mess_not_result = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_203');
                return redirect()->action('Companies\JobsController@searchJob')->with('message',$mess_not_result);
            }

        } catch (Exception $e){
            return $e;
        }
    }

}