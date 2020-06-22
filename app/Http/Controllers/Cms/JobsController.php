<?php

namespace App\Http\Controllers\Cms;

use App\Models\Jobs;
use App\Models\Companies;
use App\Models\Cities;
use App\Models\Tags;
use App\Models\Jobtypes;
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
use Illuminate\Support\Facades\Response;


class JobsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
        $this->middleware('auth'); 
    }
    /**
     * Description: Show all jobs.
     * Paginatr jobs
     * @version:V.1
     * @author: VPDuy 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       try {
           $cities    = Cities::all();
           $tags    = Tags::all();
           $jobs = DB::table('companies')
                ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                ->join('cities', 'jobs.address_city_id', '=','cities.id')
                ->select('companies.name as comName'
                    ,'cities.name_vi as citiName'
                    ,'jobs.id as ids'
                    ,'jobs.name as name'
                    ,'jobs.created as created'
                    ,'jobs.tags as tags')
                ->where('jobs.delete_flg', 0)
                ->paginate(10);
                return view('cms/jobs.index',compact('jobs','cities','tags',$jobs)); 
       } catch (Exception $e) {
            return redirect()->action('Cms\JobsController@index')->with('message',$e);
       }
       
    }

    /**
     * Description:Display form add jobs.
     * @version:V.1
     * @author: VPDuy
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms/jobs.create');

    }

    /**
     * Description:Store a newly created resource in storage.
     * received all requet from create form
     * @version:V.1
     * @author :VPDuy
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try {
            //Validate
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required',
            ]);
            //check and received data
            $alljob = $request->all();
            $name = $alljob['name'];
            $email = $alljob['email'];
            $password = $alljob['password'];
            $created_at = now(); 

            //save DB
            $dataInserdb = array(
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'created_at' => $created_at,
            );

            $job = new jobs;
            $job->insert($dataInserdb);
            return redirect()->action('Cms\jobsController@index');
       } catch (Exception $e) {
           return redirect()->action('Cms\JobsController@index')->with('message',$e);
       }
       
    }

    /**
     * Description:View info jobs by ID
     * @version:V.1
     * @author: VPDuy
     * @param  \App\jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    
    public function show($id) {
        $data = [ 
            'job' => jobs::where('id', $id)->firstOrFail()
        ];

        return view('/cms/jobs.show', $data);
    }
    /**
     * Description:Show jobs details
     * @author: VPDuy
     * @version: 1.0
     * @param  \App\jobs  
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $checkData      = new Jobs;
            $data           = $checkData->find($id); 
            //get all cities
            $cities         = Cities::all(); 
            //get all ITtags
            $tags           = Tags::all(); 
            //get all jobtypes
            $jobstypes      = Jobtypes::all();
            $getjobstype    = Jobtypes::with(['Jobs'])->where('id',$id)->firstOrFail();
            $data = [
               'jobs'       =>  Jobs::where('id',$id)->firstOrFail(),
               'companies'  =>  Companies::with(['jobs'])->where('id',$data->company_id)->firstOrFail(),
               'jobtypes'   =>  Jobtypes::with(['jobs'])->where('id',$data->job_type_id)->firstOrFail(),
               'city'       =>  Cities::with(['jobs'])->where('id',$data->address_city_id)->firstOrFail()
           ];
           return view('/cms/jobs.edit', $data, compact('cities','tags','jobstypes'));
        } catch (Exception $e) {
            return redirect()->action('Cms\JobsController@index')->with('message',$e); 
        }
        
   }
     /**
     * Description: Update info jobs and info companies .
     * Data received from in form edit .
     * @author: VPDuy
     * @version: V.1
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Jobs $Jobs){
        try {
             //Validate
            $request->validate([
                'nameComp' => 'required|min:3',
                'name'     => 'required|min:3'
            ]);
         //Check info input
            $allData        = $request->all();
            $nameComp       = $allData['nameComp'];
            $representative = $allData['representative'];
            $name           = $allData['name'];
            $job_type_id    = $allData['job_type_id'];
            $tags           = $allData['tags'];
            $description    = $allData['description'];
            $requirement    = $allData['requirement'];
            $experience     = $allData['experience'];
            $age_from       = $allData['age_from'];
            $age_to         = $allData['age_to'];
            $working_time   = $allData['working_time'];
            $address        = $allData['address'];
            $address_city_id = $allData['address_city_id'];
            $welfare        = $allData['welfare'];
            $email_receive  = $allData['email_receive'];
            $expire_date    = $allData['expire_date'];
            $company_id     = $allData['id'];
            $jobstags       = json_encode($tags);     
        //Update DB
             DB::beginTransaction();
            try {
                DB::table('companies')
                ->where('id', $company_id)
                ->update([
                    'name'          => $nameComp,
                    'representative'=> $representative,
                    'delete_flg'   => 0,
                    'modified'     => now(), 
                ]);
                DB::table('jobs')
                ->where('company_id', $company_id)
                ->update([
                    'name'          => $name,
                    'job_type_id'   => $job_type_id,
                    'tags'          => $jobstags,
                    'description'   => $description,
                    'requirement'   => $requirement,
                    'experience'    => $experience,
                    'age_from'      => $age_from,
                    'age_to'        => $age_to,
                    'working_time'  => $working_time,
                    'address'       => $address,
                    'address_city_id' => $address_city_id,
                    'welfare'       => $welfare,
                    'email_receive' => $email_receive,
                    'expire_date'   => date("Y-m-d", strtotime($expire_date)),
                    'delete_flg'   => 0,
                    'modified'     => now(), 
                ]);
                DB::commit();
                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Cms\JobsController@index')->with('message',$mess);
            }
             catch (Exception $e) {
             DB::rollBack();
             return redirect()->action('Cms\UsersController@index')->with('message',$e);
          }
        } catch (Exception $e) {
          return redirect()->action('Cms\JobsController@index')->with('message',$e);  
      }

  }
      /**
     * Description: Search by name or email or role or dateCreated 
     * Input name or email.  
     * @author: VPDuy
     * @version:V.1
     * @result: info user sample name or email.
     */
    public function search(){
        $cities    = Cities::all();
        $tags    = Tags::all();
        $name = Input::get('name');
        $company = Input::get('company');
        $skill = Input::get('tags');
        $city = Input::get('cities');
        $date_start = Input::get('datestart');
        $date_end = Input::get('enddate');
        $date_start_fmt = date('Y-m-d', strtotime($date_start));
        $date_end_fmt= date('Y-m-d', strtotime($date_end));
        $datenow = date('Y-m-d', strtotime(now()));

        //Query
        $query =  DB::table('companies')
                ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                ->join('cities', 'jobs.address_city_id', '=','cities.id')
                ->select('companies.name as comName'
                    ,'cities.name_vi as citiName'
                    ,'jobs.id as ids'
                    ,'jobs.name as name'
                    ,'jobs.created as created'
                    ,'jobs.tags as tags')
                ->where('jobs.delete_flg', 0);
        $is_first = false;        
        if ($name != "") {
            if($is_first)
            {
                $query->orWhere('jobs.name','LIKE','%'.$name.'%');    
            }else{
                $is_first = True;
                $query->where('jobs.name','LIKE','%'.$name.'%');    
            }            
        } 
        if ($company != "") {
            if($is_first){
                $query->orWhere('companies.name','LIKE','%'.$company.'%');    
            }else{
                $is_first = true;
                $query->where('companies.name','LIKE','%'.$company.'%');    
            }            
        }
        if ($skill != "") {
            if($is_first){
                $query->orWhere('jobs.tags','LIKE','%'.$skill.'%');   
            }else{
                $is_first = true;
                $query->where('jobs.tags','LIKE','%'.$skill.'%');
            }            
        }
        if ($city != "") {
            if($is_first){
                $query->orWhere('cities.name_vi','LIKE','%'.$city.'%');    
            }
            else{
                $is_first = true;
                $query->where('cities.name_vi','LIKE','%'.$city.'%');
            }            
        }
        if ($date_start_fmt != $datenow) {
            if ($is_first)
                $query->orWhereBetween('jobs.created',[$date_start_fmt, $date_end_fmt]);
            else{
                $is_first = True;
                $query->WhereBetween('jobs.created',[$date_start_fmt, $date_end_fmt]);
            } 
        }
        if($name == "" && $company == "" && $skill == "" && $city == "" && $date_start_fmt == "1970-01-01" && $date_end_fmt == "1970-01-01"){
            if($is_first)
            {
                $query->orWhere('jobs.name','LIKE','%'.$name.'%');    
            }else{
                $is_first = True;
                $query->where('jobs.name','LIKE','%'.$name.'%');    
            }   
        } 
        $jobs = $query->where('jobs.delete_flg', 0)->get();
        if(count($jobs)>=0){ 
            $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_105');
            return view('cms/jobs/search',compact('cities','tags',$cities,$tags))
                 ->withDetails($jobs)             
                 ->with('message',$mess_v3);
             }
        else{ 
            $mess_v2 = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_203');
            return redirect()->action('Cms\JobsController@search')->with('message',$mess_v2);
            }   
    }
    /**
     * Create function export csv file.
     * @author: VPDuy
     * @return void
     * @version: V.1
     */
    public function exportFile(){
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=galleries.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
                ];

                $list = Jobs::all()->toArray();
                $columns = array(`name`,`salary_from`,`salary_to`,`age_from`,`age_to`,`bonus`,`tags`,`working_time`,`experience`,`requirement`,`description`,`welfare`,`address`,`created`);
                # add headers for each column in the CSV download
                array_unshift($list, array_keys($list[0]));

               $callback = function() use ($list,$columns) 
                {
                    $FH = fopen('php://output', 'w');
                    foreach ($list as $row) { 
                        fputcsv($FH, $row);
                    }
                    fclose($FH);
                };

                return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;
    } 
    /**
     * Description: Remove the specified resource from storage.
     * @param  \App\jobs  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(Jobs::find($id)){
                $job = Jobs::find($id);
            //$user->delete();
                DB::table('jobs')
                ->where('id', $id)
                ->update([
                    'delete_flg'   => 1,
                    'modified'     => now(),
                ]);
                $mess_v2 = config('master.MESSAGE_NOTIFICATION.MSG_104'); 
                return redirect()->action('Cms\JobsController@index')->with('message',$mess_v2);
            } else {
             $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_202'); 
             return redirect()->action('Cms\JobsController@index')->with('message',$mess_v3); 
         }
     } catch (Exception $e) {
        return redirect()->action('Cms\JobsController@index')->with('message',$e); 
    }

}
}
