<?php

namespace App\Http\Controllers\Cms;

use App\Models\Applies;
use App\Models\Candidates;
use App\Models\Scouters;
use App\Models\Companies;
use App\Models\Users;
use App\Models\Jobs;
use App\Models\Tags;
use App\Models\Cities;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Services\PayUService\Exception;


class AppliesController extends Controller
{
  /**
     * Description:  show all Applies. 
     * Function: index()
     * @author: VPDuy
     * @version: 1.0
     * @return \Illuminate\Http\Response
     */
  public function index(Request $request)
  {   
    try {
        $applies = DB::table('applies')
            ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
            ->join('jobs', 'applies.job_id', '=','jobs.id')
            ->join('scouters', 'applies.scouter_id', '=','scouters.id')
            ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
            ->join('users', 'users.id', '=','scouters.member_id')
            ->select('candidates.name as canName'
                ,'candidates.email as canEmail'
                ,'users.name as scouName'
                ,'jobs.name as jobsName'
                ,'applies.created as created'
                ,'applies.id as ids')
            ->where('applies.delete_flg', 0)
            ->paginate(10);
            return view('cms/applies.index',compact('applies',$applies));
    } catch (Exception $e) {
        return redirect()->action('Cms\AppliesController@index')->with('message',$e);
    }
    
}
	/**
     * Show info user apples by ID 
     * @author: VPDuy
     * @version: 1.0
     * @param  \App\applies  
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $allData = new Applies();
        $getApplies = $allData->find($id);

        //get all ITtags
        $tags           = Tags::all();
        //get all cities
        $citi          = Cities::all();
        $getaddressid   = Candidates::with(['applies'])->where('id', $getApplies->candidate_id)->firstOrFail();
        //get applies jobs
        $jobsApplies = DB::table('applies')
        ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
        ->join('jobs', 'applies.job_id', '=','jobs.id')
        ->join('companies', 'companies.id', '=', 'jobs.company_id')
        ->join('scouters', 'applies.scouter_id', '=','scouters.id')
        ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
        ->join('users', 'users.id', '=','scouters.member_id')
        ->select('candidates.name as canName'
            ,'companies.name as comName'
            ,'jobs.id as jid'
            ,'jobs.name as joName'
            ,'jobs.created as joCreated'
            ,'candidates.email as canEmail'
            ,'users.name as scouName'
            ,'applies.created as created'
            ,'applies.id as ids')
        ->where('candidate_id', $getApplies->candidate_id)
        ->where('applies.delete_flg', 0)
        ->paginate(10); 
        
        $data = [ 
            'applies'       =>  Applies::where('id', $id)->firstOrFail(),
            'candidates'    =>  Candidates::with(['applies'])->where('id', $getApplies->candidate_id)->firstOrFail(),
            'scouters'      =>  Scouters::with(['applies'])->where('id', $getApplies->scouter_id)->firstOrFail(),
            'users'         =>  Users::with(['scouters'])->firstOrFail(),
            'jobs'          =>  Jobs::with(['Applies'])->where('id', $getApplies->job_id)->firstOrFail(),
            'cities'        =>  Cities::with(['candidates'])->where('id', $getaddressid->address_city_id)->firstOrFail(),
      ];
     
      return view('cms/applies.edit',$data, compact('tags','citi','jobsApplies'));
  }
    /**
     * Review info candidates 
     * @author: VPDuy
     * @version: 1.0
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\applies  $applies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applies $applies)
    {
      try {
            //Validate
            $request->validate([
                'name' => 'required|min:6',
                'email'     => 'required'
            ]);
            //Check info input
            $allData        = $request->all();
            $name           = $allData['name'];
            $email          = $allData['email'];
            $phone_number   = $allData['phone_number'];
            $gender         = $allData['gender'];
            $address        = $allData['address_city_id'];
            $tags           = $allData['tags'];
            $applies_id     = $allData['id'];
            $jobstags       = json_encode($tags); 
            $applies = new Applies();
            $getApplies = $applies->find($applies_id);
           
            //Update DB
            DB::beginTransaction();              
            try {
                   //check upload cv_url
            if($request->hasFile('cv_url')){
                $cv_url             = $request->file('cv_url');
                $filename_cv_url    = time() . '.' . $cv_url->getClientOriginalExtension();

                $cv_urlPath         = public_path('/files/cv/'); 
                // upload image in folder
                $cv_url->move($cv_urlPath,$filename_cv_url);
                DB::table('applies')
                ->where('id', $applies_id)
                ->update([
                    'cv_url'          => $cv_url,
                    'delete_flg'      => 0,
                    'modified'        => now(), 
                ]);
                DB::table('candidates')
                ->where('id', $getApplies->candidate_id)
                ->update([
                    'name'          => $name,
                    'email'         => $email,
                    'phone_number'  => $phone_number,
                    'gender'        => $gender,
                    'address_city_id'       => $address,
                    'tags'          => $jobstags,
                    'delete_flg'    => 0,
                    'modified'      => now(), 
                ]);
            }else{ 
                $cv_url_old = $allData['cv_url_old'];    
                DB::table('applies')
                ->where('id', $applies_id)
                ->update([
                    'cv_url'          => $cv_url_old,
                    'delete_flg'      => 0,
                    'modified'        => now(),
                ]);    
                DB::table('candidates')
                ->where('id', $getApplies->candidate_id)
                ->update([
                    'name'          => $name,
                    'email'         => $email,
                    'phone_number'  => $phone_number,
                    'gender'        => $gender,
                    'address_city_id'       => $address,
                    'delete_flg'    => 0,
                    'modified'      => now(), 
                ]);
             }
                DB::commit();
                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Cms\AppliesController@index')->with('message',$mess);
           }
                catch (Exception $e) {
                DB::rollBack();
                return redirect()->action('Cms\AppliesController@index')->with('message',$e);
            }
       
              
            } catch (Exception $e) {
            return redirect()->action('Cms\AppliesController@index')->with('message',$e);  
            }
    }
     /**
    * Description : View list cadidates from table applies group by Scouters
    * Function listApplies
    * @version: V.1
    * @author: VPDuy
    * @param : $id scouters
    * @return: list applies
    */
    public function listApplies($id){

        $scouter = new Scouters;
        $ScouterID = $scouter->find($id);

        $applies = DB::table('applies')
        ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
        ->join('jobs', 'applies.job_id', '=','jobs.id')
        ->join('scouters', 'applies.scouter_id', '=','scouters.id')
        ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
        ->join('users', 'users.id', '=','scouters.member_id')
        ->select('candidates.name as canName'
            ,'candidates.email as canEmail'
            ,'users.name as scouName'
            ,'applies.created as created'
            ,'applies.id as ids')
        ->where('scouter_id', $ScouterID->id)
        ->paginate(10); 
        return view('cms/users.listApplies',compact('applies',$applies));
    }
     /**
    * Description : View list jobs from table jobs group by candidate group by name candidates
    * Function listJObsApplies
    * @version: V.1
    * @author: VPDuy
    * @param : $name candidate
    * @return: list jobs
    */
    public function listJobsApplies($id){

        $candidates = new Candidates;
        $CandidatesID = $candidates->find($id);

        $jobsApplies = DB::table('applies')
        ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
        ->join('jobs', 'applies.job_id', '=','jobs.id')
        ->join('scouters', 'applies.scouter_id', '=','scouters.id')
        ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
        ->join('users', 'users.id', '=','scouters.member_id')
        ->select('candidates.name as canName'
            ,'candidates.email as canEmail'
            ,'users.name as scouName'
            ,'applies.created as created'
            ,'applies.id as ids')
        ->where('candidate_id', $CandidatesID->id)
        ->where('applies.delete_flg', 0)
        ->paginate(10); 
        return view('cms/applies.edit',$jobsApplies, compact('jobsApplies'));
    }    
    /**
     * Description: Search by name or email or role or dateCreated 
     * Input name or email.  
     * @author: VPDuy
     * @version:V.1
     * @result: info user sample name or email.
     */
    public function search(){
        $name      = Input::get('name');
        $email     = Input::get('email');
        $scouter   = Input::get('scouter');
        $jobs      = Input::get('jobs');
        $dateintro = Input::get('dateintrostart');
        $dateintro = date('Y-m-d', strtotime($dateintro));
        
        $dateintroend = Input::get('dateintroend');
        $dateintroend = date('Y-m-d', strtotime($dateintroend));  
        $datenow      = date('Y-m-d', strtotime(now()));
        //Query
        $query =  DB::table('applies')
                            ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
                            ->join('jobs', 'applies.job_id', '=','jobs.id')
                            ->join('scouters', 'applies.scouter_id', '=','scouters.id')
                            ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
                            ->join('users', 'users.id', '=','scouters.member_id')
                            ->select('candidates.name as canName'
                                    ,'candidates.email as canEmail'
                                    ,'users.name as scouName'
                                    ,'jobs.name as jobsName'
                                    ,'applies.created as created'
                                    ,'applies.id as ids')
                            ->where('applies.delete_flg', 0);
        $is_first = false;
        if ($name != "") {
            if($is_first){
                $query->orWhere('candidates.name','LIKE','%'.$name.'%');    
            }else{
                $is_first = True;
                $query->where('candidates.name','LIKE','%'.$name.'%');
            }            
        } 
        if ($email != "") {
            if ($is_first)
                $query->orWhere('candidates.email','LIKE','%'.$email.'%');
            else{
                $is_first = True;
                $query->where('candidates.email','LIKE','%'.$email.'%');
            } 
        }
        if ($scouter != "") {
            if ($is_first)
                $query->orWhere('users.name','LIKE','%'.$scouter.'%');
            else{
                $is_first = True;
                $query->where('users.name','LIKE','%'.$scouter.'%');
            } 
        }
        if ($jobs != "") {
            if ($is_first)
                $query->orWhere('jobs.name','LIKE','%'.$jobs.'%');
            else{
                $is_first = True;
                $query->where('jobs.name','LIKE','%'.$jobs.'%');
            } 
        }
        if ($dateintro != $datenow) {
            if ($is_first)
                $query->orWhereBetween('applies.created',[$dateintro, $dateintroend]);
            else{
                $is_first = True;
                $query->WhereBetween('applies.created',[$dateintro, $dateintroend]);
            } 
        }
        if($name == "" && $email == "" && $scouter == "" && $jobs == "" && $dateintro == "1970-01-01" && $dateintroend == "1970-01-01"){
            if($is_first){
                $query->orWhere('candidates.name','LIKE','%'.$name.'%');    
            }else{
                $is_first = True;
                $query->where('candidates.name','LIKE','%'.$name.'%');
            }   
        } 
        $applies = $query->where('applies.delete_flg', 0)->get();        
        if(count($applies)>=0){             
            $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_105');
            return view('cms/applies/search')->withDetails($applies)                
                 ->with('message',$mess_v3);
             }
        else{ 
            $mess_v2 = config('master.MESSAGE_NOTIFICATION.MSG_105');
            return redirect()->action('Cms\AppliesController@search')->with('message',$mess_v2);
            }      

    }
    /**
     * Description: Remove the specified resource from storage.
     * @param  \App\applies  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(Applies::find($id)){
                $applie = Applies::find($id);
            //$user->delete();
                DB::table('applies')
                ->where('id', $id)
                ->update([
                    'delete_flg'   => 1,
                    'modified'     => now(),
                ]);
                $mess_v2 = config('master.MESSAGE_NOTIFICATION.MSG_104'); 
                return redirect()->action('Cms\AppliesController@index')->with('message',$mess_v2);
            } else {
             $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_202'); 
             return redirect()->action('Cms\AppliesController@index')->with('message',$mess_v3); 
         }
     } catch (Exception $e) {
        return redirect()->action('Cms\AppliesController@index')->with('message',$e); 
    }

}
}
