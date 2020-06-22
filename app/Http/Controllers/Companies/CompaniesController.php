<?php

namespace App\Http\Controllers\Companies;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Jobtypes;
use App\Models\Cities;
use App\Models\Jobs;
use App\Models\Tags;
use App\Models\Companies;
use App\Models\Countries;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Services\PayUService\Exception;


class CompaniesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('front/companies.index', compact('user'));
    }

    /**
     * POSTJOB functions
     */
    public function postjob(Request $request)
    {
    	if ($request->isMethod('get')) {
        	return $this->get_postjob($request);
    	} else if ($request->isMethod('put')) {
    		return $this->put_postjob($request);
    	} else if ($request->isMethod('post')) {
    		return $this->post_postjob($request);
    	}
    }

    public function get_postjob(Request $request)
    {
        $user = Auth::user();
        $company_obj = DB::table('companies')->select()->where('member_id',$user->id)->first();
        $cities     = Cities::all();
        $jobtypes   = Jobtypes::all();
        $tags       = Tags::all();
        $job_id = 0;
        if($request->has('jobid')) {
            $job_id = $request->jobid;
            if (is_numeric($job_id)) {
                $job_obj = Jobs::find($job_id);
                if(!is_null($job_obj))
                {
                    $job_obj->expire_date = date('Y-m-d', strtotime($job_obj->expire_date));
                    return view('front/companies.postjob', compact('jobtypes','company_obj','cities','tags','user','job_obj'));
                }
            }
        } 
        return view('front/companies.postjob', compact('jobtypes','company_obj','cities','tags','user'));
    }

    public function put_postjob(Request $request )
    {
    	// try {
        // $user   = Users::find(auth()->user()->id);
        $job_req    = $request->all();
        $job_title      = $job_req['job_title'];
        $job_tag        = $job_req['job_tag'];
        $job_type        = $job_req['job_type'];
        $job_description    = $job_req['job_description'];
        $job_requirement   = $job_req['job_requirement'];
        $job_experience   = $job_req['job_experience'];
        $job_age_from    = $job_req['job_age_from'];
        $job_age_to    = $job_req['job_age_to'];
        $job_bonus_from    = $job_req['job_bonus_from'];
        $job_bonus_to    = $job_req['job_bonus_to'];
        $job_worktime    = $job_req['job_worktime'];
        $job_address   = $job_req['job_address'];
        $job_address_city   = $job_req['job_address_city'];
        $job_salary_from   = $job_req['job_salary_from'];
        $job_salary_to   = $job_req['job_salary_to'];
        $job_welfare   = $job_req['job_welfare'];
        $job_email   = $job_req['job_email'];
        $job_expired   = $job_req['job_expired'];
        $company_id     = $job_req['company_id'];

        // print_r
        // DB::beginTransaction();
        try {
            $job_obj = new jobs;
            $job_obj->insert([
                    'name'          => $job_title,
                    'job_type_id'   => $job_type,
                    'company_id'    => $company_id,
                    'tags'          => $job_tag,
                    'description'   => $job_description,
                    'requirement'   => $job_requirement,
                    'experience'    => $job_experience,
                    'age_from'      => $job_age_from,
                    'age_to'        => $job_age_to,
                    'bonus_from'    => $job_bonus_from,
                    'bonus_to'    => $job_bonus_to,
                    'salary_from'    => $job_salary_from,
                    'salary_to'     => $job_salary_to,
                    'working_time'  => $job_worktime,
                    'address'       => $job_address,
                    'address_city_id' => $job_address_city,
                    'welfare'       => $job_welfare,
                    'email_receive' => $job_email,
                    'expire_date'   => date("Y-m-d", strtotime($job_expired)),
                    'delete_flg'   => 0,
                    'modified'     => now(), 
                    'created'       => now(), 
                ]);
                    
            // DB::commit();
            $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
            return redirect()->action('Companies\CompaniesController@postjob');
        } catch (Exception $e) {
            return redirect()->action('Companies\CompaniesController@postjob')->with('message',$e);
        }
    }

    public function post_postjob(Request $request )
    {
        $job_req    = $request->all();
        $company_id     = $job_req['company_id'];
        $job_id         = $job_req['job_id'];
        $job_title      = $job_req['job_title'];
        $job_tag        = $job_req['job_tag'];
        $job_type       = $job_req['job_type'];
        $job_description    = $job_req['job_description'];
        $job_requirement    = $job_req['job_requirement'];
        $job_experience = $job_req['job_experience'];
        $job_age_from   = $job_req['job_age_from'];
        $job_age_to     = $job_req['job_age_to'];
        $job_bonus_from = $job_req['job_bonus_from'];
        $job_bonus_to   = $job_req['job_bonus_to'];
        $job_worktime   = $job_req['job_worktime'];
        $job_address    = $job_req['job_address'];
        $job_address_city   = $job_req['job_address_city'];
        $job_salary_from    = $job_req['job_salary_from'];
        $job_salary_to  = $job_req['job_salary_to'];
        $job_welfare    = $job_req['job_welfare'];
        $job_email      = $job_req['job_email'];
        $job_expired    = $job_req['job_expired'];
        
        if (!is_numeric($job_id)) {
            $mess = config('master.MESSAGE_NOTIFICATION.MSG_404');
            return redirect()->action('Companies\CompaniesController@postjob')->with('message',$mess);
        }
        $job_obj = Jobs::find($job_id);
        if(is_null($job_obj)){
            $mess = config('master.MESSAGE_NOTIFICATION.MSG_404'); 
            return redirect()->action('Companies\CompaniesController@postjob')->with('message',$mess);
        }
        if ($job_obj->company_id != $company_id) 
        {
            $mess = "JOB IS NOT OF COMPANY"; 
            return redirect()->action('Companies\CompaniesController@postjob')->with('message',$mess);
        }
        // Update job
        $job_obj->name          = $job_title;
        $job_obj->job_type_id   = $job_type;
        $job_obj->tags          = $job_tag;
        $job_obj->description   = $job_description;
        $job_obj->requirement   = $job_requirement;
        $job_obj->experience    = $job_experience;
        $job_obj->age_from      = $job_age_from;
        $job_obj->age_to        = $job_age_to;
        $job_obj->bonus_from    = $job_bonus_from;
        $job_obj->bonus_to      = $job_bonus_to;
        $job_obj->salary_from   = $job_salary_from;
        $job_obj->salary_to     = $job_salary_to;
        $job_obj->working_time  = $job_worktime;
        $job_obj->address       = $job_address;
        $job_obj->address_city_id   = $job_address_city;
        $job_obj->welfare       = $job_welfare;
        $job_obj->email_receive = $job_email;
        $job_obj->expire_date   = date("Y-m-d", strtotime($job_expired));
        $job_obj->modified      = now();

        $job_obj->save();
        return redirect()->action('Companies\CompaniesController@postjob');
    }
    
    /**
     * PROFILE functions
     */
    public function company_profile(Request $request)
    {
        $user = Auth::user();
        if(is_null($user)){
            return redirect()->action('Auth\LoginController@showLoginForm');
        }
    	if ($request->isMethod('get')) {
        	return $this->get_company_profile();
    	} else if ($request->isMethod('post')) {
    		return $this->post_company_profile($request);
    	} else if ($request->isMethod('put')) {
    		return $this->put_company_profile($request);
    	}
    }

    public function get_company_profile()
    {
        $user = Auth::user();
        $company_obj = DB::table('companies')->select()->where('member_id', $user->id)->first();
        $country_objs = Countries::all();
        //get workingDay
        $workingDays    = config('master.WORKING_DAYS');
    	//get OVERTIME_TYPES
        $overtimeTypes  = config('master.OVERTIME_TYPES');
        //get COMPANY_TYPES
        $companyTypes   = config('master.COMPANY_TYPES');
        if(is_null($company_obj)) {
            return view('front/companies.profile', 
                        compact('country_objs','overtimeTypes', 'companyTypes', 'workingDays','user'));
        }
        return view('front/companies.profile', 
                        compact('company_obj', 'country_objs','overtimeTypes', 'companyTypes', 'workingDays','user'));
    }

    public function post_company_profile(Request $request)
    {
        $company_req    = $request->all();
        $company_id     = $company_req['company_id'];
        $company_name   = $company_req['company_name'];
        $company_ceo    = $company_req['company_ceo'];
        $company_type   = $company_req['company_type'];
        $company_phone_number   = $company_req['company_phone_number'];
        $company_address    = $company_req['company_address'];
        $company_website    = $company_req['company_website'];
        $company_no_staff   = $company_req['company_no_staff'];
        $company_date_establishment   = $company_req['company_date_establishment'];
        $company_work_from  = $company_req['company_work_from'];
        $company_work_to    = $company_req['company_work_to'];
        $company_bonus_ot    = $company_req['company_bonus_ot'];
        $company_about      = $company_req['company_about'];
        
        if($request->hasFile('company_banner_file')||$request->hasFile('company_logo_file')) {
            $company_banner     = $request->company_banner_file;
            $company_logo       = $request->company_logo_file;

            $filename_banner    = time() . '.' . $company_banner->getClientOriginalExtension();
            $filename_logo      = time() . '.' . $company_logo->getClientOriginalExtension();

            $bannerPath         = public_path('/files/banner/');
            $logoPath           = public_path('/files/avatar/company/');
            $company_banner->move($bannerPath,$filename_banner);
            $company_logo->move($logoPath,$filename_logo);

            DB::beginTransaction();
            try {
                DB::table('companies')
                ->where('id', $company_id)
                ->update([
                    'name'                  => $company_name,
                    'work_from'             => $company_work_from,
                    'work_to'               => $company_work_to,
                    'company_type_id'       => $company_type,
                    'overtime_id'           => $company_bonus_ot,
                    'address'               => $company_address,
                    'phone_number'          => $company_phone_number,
                    'representative'        => $company_ceo,
                    'web_url'               => $company_website,
                    'members'               => $company_no_staff,
                    'foundation_date'       => date("Y-m-d H:i:s", strtotime($company_date_establishment)),  
                    'description'           => $company_about,
                    'banner_url'            => $filename_banner,
                    'logo_url'              => $filename_logo,
                    'delete_flg'            => 0,
                    'modified'              => now(),
                ]);
                DB::commit();
                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Companies\CompaniesController@company_profile')->with('message',$mess);
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->action('Companies\CompaniesController@company_profile')->with('message',$e);
            }
        }
    }

    public function put_company_profile(Request $request)
    {
        
        $company_req    = $request->all();
        $user_id        = $company_req['user_id'];
        $company_name   = $company_req['company_name'];
        $company_ceo    = $company_req['company_ceo'];
        $company_type   = $company_req['company_type'];
        $company_phone_number   = $company_req['company_phone_number'];
        $company_address    = $company_req['company_address'];
        $company_website    = $company_req['company_website'];
        $company_no_staff   = $company_req['company_no_staff'];
        $company_date_establishment   = $company_req['company_date_establishment'];
        $company_country    = $company_req['company_country'];
        $company_work_from  = $company_req['company_work_from'];
        $company_work_to    = $company_req['company_work_to'];
        $company_bonus_ot    = $company_req['company_bonus_ot'];
        $company_about      = $company_req['company_about'];
        
        if($request->hasFile('company_banner_file')||$request->hasFile('company_logo_file')) {
            $company_banner     = $request->company_banner_file;
            $company_logo       = $request->company_logo_file;

            $filename_banner    = time() . '.' . $company_banner->getClientOriginalExtension();
            $filename_logo      = time() . '.' . $company_logo->getClientOriginalExtension();

            $bannerPath         = public_path('/files/banner/');
            $logoPath           = public_path('/files/avatar/company/');
            $company_banner->move($bannerPath,$filename_banner);
            $company_logo->move($logoPath,$filename_logo);

            $company_obj = new Companies;
            # Assign value
            $company_obj->name      = $company_name;
            $company_obj->member_id      = $user_id;
            $company_obj->work_from      = $company_work_from;
            $company_obj->work_to      = $company_work_to;
            $company_obj->company_type_id      = $company_type;
            $company_obj->overtime_id      = $company_bonus_ot;
            $company_obj->address      = $company_address;
            $company_obj->phone_number      = $company_phone_number;
            $company_obj->representative      = $company_ceo;
            $company_obj->web_url      = $company_website;
            $company_obj->members      = $company_no_staff;
            $company_obj->foundation_date      = date("Y-m-d H:i:s", strtotime($company_date_establishment));
            $company_obj->country_id      = $company_country;
            $company_obj->address_city_id      = 11;
            $company_obj->description      = $company_about;
            $company_obj->banner_url      = $filename_banner;
            $company_obj->logo_url      = $filename_logo;
            $company_obj->delete_flg      = 0;


            try
            {
                // $company_obj->save();
                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Companies\CompaniesController@company_profile')->with('message',$mess);
            } catch (Exception $e) {
                return redirect()->action('Companies\CompaniesController@company_profile')->with('message',$e);
            }
        }
    }

    /**
     * ACCOUNT functions
     */
    public function company_account(Request $request)
    {
        $user = Auth::user();
        if(is_null($user)){
            return redirect()->action('Auth\LoginController@showLoginForm');
        }
    	if ($request->isMethod('get')) {
        	return $this->get_company_account();
    	} else if ($request->isMethod('post')) {
    		return $this->post_company_account($request);
    	} 
    }

    public function get_company_account()
    {
        $user = Auth::user();
        return view('front/companies.account', compact('user'));
    }

    public function post_company_account(Request $request)
    {
        $company_req    = $request->all();
        $save           = FALSE;
        if (isset($company_req['company_change_email'])){
            $company_email   = $company_req['company_email'];
            $user->email = $company_email;
            $save = TRUE;
        } else if (isset($company_req['company_change_pass'])) {
            $company_current_pass   = $company_req['company_current_pass'];
            $company_new_pass       = $company_req['company_new_pass'];
            $company_confirm_pass   = $company_req['company_confirm_pass'];

            if($user->password != Hash::make($company_current_pass)){
                return redirect()->action('Companies\CompaniesController@company_account')->with('message',"Current Password is not correct");
            }
            if($company_new_pass != $company_new_pass){
                return redirect()->action('Companies\CompaniesController@company_account')->with('message',"Password is not match");
            }
            $user->password = Hash::make($company_new_pass);
            $save = TRUE;
        }
        if ($save){
            $user->save();
            $mess = config('master.MESSAGE_NOTIFICATION.MSG_102');  
            return redirect()->action('Companies\CompaniesController@company_account')->with('message',$mess);
        }
        
    }

    /**
     * Show company detail
     * @author: duc.tuan
     * @version: V1
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        //check if $id not a number
        if (empty($id) || !preg_match('/^\d+$/', $id)) {
            return redirect()->route('home');
            die;
        }
        //get user from Auth
        $user = Auth::user();
        $companiesT = DB::table('companies');
        $company = $companiesT
            ->leftjoin('countries', 'countries.id', '=', 'companies.country_id')
            ->leftjoin('cities', 'cities.id', '=', 'companies.address_city_id')
            ->select('companies.name as company_name', 'companies.company_type_id', 'companies.address as company_address',
                'countries.name as country_name', 'cities.name_vi as city_name_vi', 'cities.name_en as city_name_en', 
                'companies.phone_number as company_phone_number', 'companies.web_url as company_web_url', 'companies.work_from as company_work_from',
                'companies.members as company_members', 'companies.description as company_description', 'companies.banner_url as company_banner_url', 
                'companies.logo_url as company_logo_url', 'companies.work_to as company_work_to', 'companies.overtime_id as company_overtime_id')
            ->where('companies.id', $id)
            ->first();
        if(empty($company)){
            return redirect()->route('home');
            die;
        }
        $companiesT = DB::table('companies');
        $jobs = $companiesT->select()->join('jobs', 'jobs.company_id', '=', 'companies.id')
            ->join('jobtypes', 'jobs.job_type_id', '=', 'jobtypes.id')
            ->leftjoin('cities', 'jobs.address_city_id', '=', 'cities.id')
            ->select('jobs.id', 'jobs.job_type_id', 'jobtypes.name as jobtype_name', 'jobs.name', 'jobs.salary_from', 'jobs.salary_to', 
                'jobs.bonus', 'jobs.age_from', 'jobs.age_to', 'jobs.tags', 'jobs.working_time', 
                'jobs.experience', 'jobs.requirement', 'jobs.description', 'jobs.welfare', 'jobs.address', 
                'cities.name_vi as city_name_vi', 'cities.name_en as city_name_en', 'jobs.email_receive', 'jobs.expire_date')
            ->where('companies.id', $id)
            ->orderBy('jobs.created', 'desc')
            ->get();
        $export_data = ['user', 'company', 'jobs'];
        return view('front/companies.companydetail', compact($export_data));
    }
}
