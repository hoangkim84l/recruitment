<?php

namespace App\Http\Controllers;

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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

     /**
     * Description: Show the application dashboard.
     * Paginate jobs
     * @version:V.1
     * @author: VPDuy 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $user = Auth::user();
            $cities  = Cities::all();
            $tags    = Tags::all();
            $pathCompany    = config('master.PATH_COMPANY');
            $dateNow = date('Y-m-d', strtotime(now()));
            $jobs    = DB::table('companies')
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
                    ->where('jobs.delete_flg', 0)
                    ->orderBy('jobs.id', 'DESC')
                    ->paginate(5);
            $hotJobs    = DB::table('companies')
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
                    ->where('jobs.delete_flg', 0)
                    ->orderBy('jobs.bonus', 'DESC')
                    ->paginate(3);        
                 return view('front/home.index',compact('jobs','cities','tags','hotJobs','user','pathCompany',$jobs,$hotJobs,$user)); 
        } catch (Exception $e) {
             return redirect()->action('HomeController@index')->with('message',$e);
        }
    }
    /**
     * Description: Show introduce page.
     * introduce
     * @version:V.1
     * @author: VPDuy 
     * @return null
     */
    public function introduce()
    {
        return view('front/home.introduce');
    }
    /**
     * Description: Show contact page.
     * contact
     * @version:V.1
     * @author: VPDuy 
     * @return null
     */
    public function contact()
    {
        return view('front/home.contact');
    }
}