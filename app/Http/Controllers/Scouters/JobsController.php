<?php
namespace App\Http\Controllers\Scouters;

use App\Models\Jobs;
use App\Models\Companies;
use App\Models\Cities;
use App\Models\Tags;
use App\Models\Jobtypes;
use Session;
use App\Helper\commonHelper;
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
     * Description: show all jobs
     * @author: VPDuy
     * @version: V1
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        try {
            $pathCompany    = config('master.PATH_COMPANY');
            $user = Auth::user();
            $jobs = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('companies.name as comName'
                        ,'cities.name_vi as citiName_vi'
                        ,'cities.name_en as citiName_en'
                        ,'jobs.id as ids'
                        ,'jobs.name as name'
                        ,'jobs.created as created'
                        ,'jobs.tags as tags'
                        ,'jobs.salary_from as salary_from'
                        ,'jobs.salary_to as salary_to'
                        ,'jobs.bonus as bonus'
                        ,'jobs.description as description'
                        ,'jobs.address as address'
                        ,'jobtypes.name as typename'
                        ,'companies.logo_url as logo_url'
                        ,'companies.id as coId')
                    ->where('jobs.delete_flg', 0)
                    ->orderBy('jobs.id', 'DESC')
                    ->paginate(10);
            //sort where type full time
            $jobtypesFulltime = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('jobtypes.name as typename')
                    ->where('jobs.job_type_id', 1)->get();  
            //sort where type Part time
            $jobtypesParttime = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('jobtypes.name as typename')
                    ->where('jobs.job_type_id', 2)->get();
            //sort where type Internship
            $jobtypesInternship = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('jobtypes.name as typename')
                    ->where('jobs.job_type_id', 3)->get(); 
            //sort where type Freelance
            $jobtypesFreelance = DB::table('companies')
                        ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                        ->join('cities', 'jobs.address_city_id', '=','cities.id')
                        ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                        ->select('jobtypes.name as typename')
                      ->where('jobs.job_type_id', 4)->get();
                           
                 return view('front/scouters.scouterjobindex',compact('jobs','user','jobtypesFulltime','jobtypesParttime','jobtypesInternship','pathCompany','jobtypesFreelance',$jobs)); 
        } catch (Exception $e) {
             return redirect()->action('Scouters\JobsController@index')->with('message',$e);
        }
    }
     /**
     * Description: search job where IT skill, job name, company name, city, sort and job type.
     * @author: VPDuy
     * @version: V1
     * @return \Illuminate\Http\Response
     */
    public function search()
    {          
        try {
            //get data at form
            $name = Input::get('name');
            $city = Input::get('city');
            //query 
            $pathCompany    = config('master.PATH_COMPANY');
            $user = Auth::user();
            $query = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('companies.name as comName'
                        ,'cities.name_vi as citiName_vi'
                        ,'cities.name_en as citiName_en'
                        ,'jobs.id as ids'
                        ,'jobs.name as name'
                        ,'jobs.created as created'
                        ,'jobs.tags as tags'
                        ,'jobs.salary_from as salary_from'
                        ,'jobs.salary_to as salary_to'
                        ,'jobs.bonus as bonus'
                        ,'jobs.description as description'
                        ,'jobs.address as address'
                        ,'jobtypes.name as typename'
                        ,'companies.logo_url as logo_url')
                    ->where('jobs.delete_flg', 0);
                //flag
                $flag = false;
                //search
                if ($name != "") {
                    if($flag){
                        $query->orWhere('jobs.name','LIKE','%'.$name.'%');
                    }else{
                        $flag = True;
                        $query->where('jobs.name','LIKE','%'.$name.'%');
                    }            
                }
                if ($city != "") {
                    if($flag){
                        $query->orWhere('jobs.address','LIKE','%'.$city.'%');
                    }else{
                        $flag = True;
                        $query->where('jobs.address','LIKE','%'.$city.'%');
                    }            
                }
                if($name == "" && $city == ""){
                    if($flag)
                    {
                        $query->orWhere('jobs.name','LIKE','%'.$name.'%');    
                    }else{
                        $flag = True;
                        $query->where('jobs.name','LIKE','%'.$name.'%');    
                    }   
                } 
                
                $jobs = $query->where('jobs.delete_flg', 0)
                            ->paginate(10);
                //sort where type full time
                $jobtypesFulltime = DB::table('companies')
                ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                ->join('cities', 'jobs.address_city_id', '=','cities.id')
                ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                ->select('jobtypes.name as typename')
                ->where('jobs.job_type_id', 1)->get();  
                //sort where type Part time
                $jobtypesParttime = DB::table('companies')
                        ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                        ->join('cities', 'jobs.address_city_id', '=','cities.id')
                        ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                        ->select('jobtypes.name as typename')
                        ->where('jobs.job_type_id', 2)->get();
                //sort where type Internship
                $jobtypesInternship = DB::table('companies')
                        ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                        ->join('cities', 'jobs.address_city_id', '=','cities.id')
                        ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                        ->select('jobtypes.name as typename')
                        ->where('jobs.job_type_id', 3)->get(); 
                //sort where type Freelance
                $jobtypesFreelance = DB::table('companies')
                            ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                            ->join('cities', 'jobs.address_city_id', '=','cities.id')
                            ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                            ->select('jobtypes.name as typename')
                        ->where('jobs.job_type_id', 4)->get();
                if(count($jobs)>=0){ 
                    $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_105');
                    return view('front/scouters.scouterjobsearch',compact('jobs','user','jobtypesFulltime','jobtypesParttime','jobtypesInternship','jobtypesFreelance','pathCompany',$user,$jobs))->withDetails($jobs)                
                         ->with('message',$mess_v3);
                     }
                else{ 
                    $mess_v2 = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_203');
                    return redirect()->action('Scouters\JobsController@search')->with('message',$mess_v2);
                    }      
          
            } catch (Exception $e) {
                return redirect()->action('Scouters\JobsController@search')->with('message',$e);
            }
    }
    /**
     * Description : filter jobs by full-time, part-time, interShip, Freelance
     * @author: VPDuy
     * @version: V1 
    */

    public function checkJobsType()
    {
        $pathCompany    = config('master.PATH_COMPANY');
        $user = Auth::user();
        $check = Input::get('check');
        $sortBy = Input::get('sortNew');
       
        if($sortBy=='oldest'){
            $type = 'DESC';
            $field = 'jobs.id';
        }
        elseif($sortBy=='newest'){
            $type = 'ASC';
             $field = 'jobs.id';
        }
        elseif($sortBy=='hightsalary'){
            $type = 'DESC';
             $field = 'jobs.salary_to';
        }
        elseif($sortBy=='hightbonus'){
            $type = 'DESC';
             $field = 'jobs.bonus';
        }
       
        $query = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('companies.name as comName'
                        ,'cities.name_vi as citiName_vi'
                        ,'cities.name_en as citiName_en'
                        ,'jobs.id as ids'
                        ,'jobs.name as name'
                        ,'jobs.created as created'
                        ,'jobs.tags as tags'
                        ,'jobs.salary_from as salary_from'
                        ,'jobs.salary_to as salary_to'
                        ,'jobs.bonus as bonus'
                        ,'jobs.description as description'
                        ,'jobs.address as address'
                        ,'jobtypes.name as typename'
                        ,'companies.logo_url as logo_url')
                        ->where('jobs.delete_flg', 0);
        if($check[0]!=0){
            $jobs =  $query->whereIn('jobs.job_type_id', $check)->orderBy($field, $type)->paginate(10);
        }        
        elseif($check[0]==0){
            $jobs =  $query->where('jobs.delete_flg', 0)->orderBy($field, $type)->paginate(10);
           
        }
        elseif($check[0]==null){
            $jobs =  $query->where('jobs.delete_flg', 0)
            ->paginate(10);
        }
        else{
            $jobs =  $query ->whereIn('jobs.job_type_id', $check)
            ->paginate(10);
        }                
                  
            //sort where type full time
            $jobtypesFulltime = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('jobtypes.name as typename')
                    ->where('jobs.job_type_id', 1)->get();  
            //sort where type Part time
            $jobtypesParttime = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('jobtypes.name as typename')
                    ->where('jobs.job_type_id', 2)->get();
            //sort where type Internship
            $jobtypesInternship = DB::table('companies')
                    ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                    ->join('cities', 'jobs.address_city_id', '=','cities.id')
                    ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                    ->select('jobtypes.name as typename')
                    ->where('jobs.job_type_id', 3)->get(); 
            //sort where type Freelance
            $jobtypesFreelance = DB::table('companies')
                        ->join('jobs', 'companies.id', '=', 'jobs.company_id')
                        ->join('cities', 'jobs.address_city_id', '=','cities.id')
                        ->join('jobtypes', 'jobs.job_type_id', '=','jobtypes.id')
                        ->select('jobtypes.name as typename')
                      ->where('jobs.job_type_id', 4)->get();
                           
                 return compact('jobs','user','jobtypesFulltime','jobtypesParttime','jobtypesInternship','jobtypesFreelance','pathCompany',$jobs); 
    }
}
