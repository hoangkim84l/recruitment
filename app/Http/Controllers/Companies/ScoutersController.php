<?php
namespace App\Http\Controllers\Companies;

use App\Models\Scouters;
use App\Models\Companies;
use App\Models\Users;
use App\Models\Jobs;
use App\Models\Applies;
use App\Models\Candidates;
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

class ScoutersController extends Controller
{
    /**
     * Description: show all scouters
     * @author: VPDuy + Do.Truong
     * @version: V1
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        try {
            $user = Auth::user();
            $jobs = DB::table('scouters')
                ->join('users', 'scouters.member_id', '=','users.id')
                ->join('applies', 'applies.scouter_id', '=','scouters.id')
                ->join('jobs', 'applies.job_id', '=', 'jobs.id')
                ->join('companies', 'jobs.company_id', '=','companies.id')
                ->groupBy('applies.scouter_id')
                ->select('scouters.id as ids'
                    ,'users.name as scouName'
                    ,'users.email as scouEmail'
                    ,'scouters.created as created'
                    ,DB::raw('count(applies.scouter_id) as countIntro')
                )
                ->where('scouters.delete_flg', 0)
                ->where('companies.member_id', $user->id)
                ->paginate(10);
            return view('front/companies.scouterindex',compact('jobs','user',$jobs));
        } catch (Exception $e) {
            return redirect()->action('Companies\ScoutersController@index')->with('message',$e);
        }
    }
    /**
     * Search scouter by scouter name.
     * @author: Do.Truong
     * @version: V1
     * @return \Illuminate\Http\Response
     */

    public function searchScouter(Request $request){
        try {
            $user = Auth::user();
            $scouterName = Input::get('scouterNameSearch');

            $query = DB::table('scouters')
                ->join('users', 'scouters.member_id', '=','users.id')
                ->join('applies', 'applies.scouter_id', '=','scouters.id')
                ->join('jobs', 'applies.job_id', '=', 'jobs.id')
                ->join('companies', 'jobs.company_id', '=','companies.id')
                ->groupBy('applies.scouter_id')
                ->select('scouters.id as ids'
                    ,'users.name as scouName'
                    ,'users.email as scouEmail'
                    ,'scouters.created as created'
                    ,DB::raw('count(applies.scouter_id) as countIntro')
                )
                ->where('scouters.delete_flg', 0)
                ->where('companies.member_id', $user->id);

            $is_first = false;
            if ($scouterName != "") {
                if($is_first)
                {
                    $query->orWhere('users.name','LIKE','%'.$scouterName.'%');
                }else{
                    $is_first = true;
                    $query->where('users.name','LIKE','%'.$scouterName.'%');
                }
            }

            $jobs = $query->get();

            return view('front/companies.scoutersearch',compact('jobs','user',$jobs));
        } catch (Exception $e) {
            return redirect()->action('Companies\ScoutersController@searchScouter')->with('message',$e);
        }
    }


    /**
     * Scouter detail.
     * @author: VPDuy + Do.Truong
     * @version: V1
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {   
        $user = Auth::user();
        $checkData      = new Scouters;
        $data           = $checkData->find($id); 
        $bonus  = config('master.BONUS_STATUS');
        $jobs = DB::table('scouters')
                ->join('users', 'scouters.member_id', '=','users.id')
                ->join('applies', 'applies.scouter_id', '=','scouters.id')
                ->leftJoin('bonus_histories', 'bonus_histories.scouter_id', '=', 'scouters.id')
                ->join('candidates', 'applies.candidate_id', '=','candidates.id')
                ->join('jobs', 'applies.job_id', '=', 'jobs.id')                 
                ->join('companies', 'jobs.company_id', '=','companies.id')                 
                ->select('scouters.id as ids',
                        'applies.id as applyId'
                        ,'users.name as scouName'
                        ,'users.email as scouEmail'
                        ,'candidates.name as canName'
                        ,'jobs.name as jobName'
                        ,'jobs.bonus as bonusMoney'
                        ,'scouters.created as created'
                        ,'bonus_histories.id as bonusHisId'
                        ,'bonus_histories.bonusstatus_id as bonusStatusId'
                )
                ->where('scouters.delete_flg', 0)
                ->where('applies.scouter_id', $data->id)
                ->paginate(10);  
        $data = [    
                'scouters'   =>  Scouters::where('id', $id)->firstOrFail(),
                'users'      =>  Users::with(['scouters'])->where('id', $data->member_id)->firstOrFail(),
        ];
         
        return view('front/companies.scouterdetail',$data,compact('jobs','user','bonus',$jobs));
    }

    /**
     * Update Bonus Status.
     * @author: Do.Truong
     * @version: V1
     * @return Status Data
     */
    public function updateBonusStatusAjax(Request $request){
        $requestData = $request->all();
        $allData = json_decode($requestData['data'], true);
        $bonusHistoryId = $allData['bonus_history_id'];

        if ($bonusHistoryId != ""){
            try {
                DB::beginTransaction();
                try{
                    DB::table('bonus_histories')
                        ->where('id', $bonusHistoryId)
                        ->update([
                            'bonusstatus_id' => $allData['bonusstatus_id']
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
            $dataInsert = [
                'apply_id' => $allData['apply_id'],
                'scouter_id' => $allData['scouter_id'],
                'bonusstatus_id' => $allData['bonusstatus_id'],
                'bonus_money' => $allData['bonus_money'],
                'delete_flg' => 0,
                'deleted_at' => null,
                'created_by' => null,
                'modified_by' => null,
                'created' => now(),
                'modified' => now(),
            ];
            try{
                DB::beginTransaction();
                try{
                    DB::table('bonus_histories')
                        ->insert($dataInsert);
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
    }
}
