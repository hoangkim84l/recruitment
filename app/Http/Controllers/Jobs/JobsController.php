<?php

namespace App\Http\Controllers\Jobs;

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
use Mail;

class JobsController extends Controller
{
   /**
     * Show details jobs by id.
     * @author: VPDuy, duc.tuan
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
        try {
            //get user from Auth
            $user = Auth::user();
            //jobs table
            $jobsT = DB::table('jobs');
            $jobs = $jobsT->get();
            $job = $jobsT->where('id', $id)->first();
            if(!empty($job)){
                // cities table
                $citiesT = DB::table('cities');
                $cities = $citiesT->get();
                $citiesT = DB::table('cities');
                $city = $citiesT->select('cities.*')->join('jobs', 'cities.id', '=', 'jobs.address_city_id')->where('cities.id', $job->address_city_id)->first();
                //companies table
                $companiesT = DB::table('companies');
                $companies = $companiesT->get();
                $companiesT = DB::table('companies');
                $company = $companiesT->select('companies.*')->join('jobs', 'companies.id', '=', 'jobs.company_id')->where('companies.id', $job->company_id)->first();
                //jobtypes table
                $jobtypesT = DB::table('jobtypes');
                $jobtypes = $jobtypesT->get();
                $jobtypesT = DB::table('jobtypes');
                $jobtype = $jobtypesT->select('jobtypes.*')->join('jobs', 'jobtypes.id', '=', 'jobs.job_type_id')->where('jobtypes.id', $job->job_type_id)->first();
                //tags table
                $tagsT = DB::table('tags');
                $tags = $tagsT->get();
                //get workingDay
                $workingDays    = config('master.WORKING_DAYS');
                //get OVERTIME_TYPES
                $overtimeTypes  = config('master.OVERTIME_TYPES');
                //get COMPANY_TYPES
                $companyTypes   = config('master.COMPANY_TYPES');
                //friends table
                $friendsT = DB::table('friends');
                $friends = $friendsT->orderBy('id', 'desc');

                $export_data = ['user', 'friends', 'job', 'jobs', 'city', 'cities', 'company', 'companies', 'jobtype', 'jobtypes', 'tags', 'workingDays', 'overtimeTypes', 'companyTypes'];
            }else{
                return redirect()->route('home');
            }
            return view('front/jobs.detail', compact($export_data)); 
        } catch (Exception $e) {
            return redirect()->route('home');
        }
    }

    /**
    * Description: Select friend send email
    * Function: sendMailSeclectAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function sendMailSeclectAjax(Request $request){
        $json = [
            'status' => 'success',
            'data' => null
        ];
        $user = Auth::user();
        $dataEmail = $request->all();
        $email = $dataEmail['email'];
        $friend =  DB::table('friends')->where('email', $email)->first();

        $emails = [$email];

        Mail::send('vendor/mail/html/scouter.messelect', ['link' => '/' . $user->id], function ($message) use ($request, $emails)
        {
            $message->from('scouter@scouter.com', 'Scouter');
            $message->to($emails);
            $message->subject('New Email From Scouter');
        });
        
        echo json_encode($json);
        exit;
    }

    /**
    * Description: Add friend and send email
    * Function: addFriendSendMailAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function addFriendSendMailAjax(Request $request){
        $json = [
            'status' => 'success',
            'data' => null
        ];
        $user = Auth::user();
        $dataForm = $request->all();
        $friendEmail = DB::table('friends')->select('email')->where('email', $dataForm['email'])->first();
                
        if(count($friendEmail) == 0){
            if(!empty($_FILES['file']['name'])){
                $filename = $_FILES['file']['name'];
                $file_tmp_name = $_FILES['file']['tmp_name'];
                $dir = public_path('UserProfiles/' . $user->id . '/friends/cv');
                
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
                $allowed = ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx'];
                
                if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                    throw new InternalErrorException('Error Processing Request.', 1);
                } elseif (is_uploaded_file($file_tmp_name)) {
                    move_uploaded_file($file_tmp_name, $dir . '/' . $filename);
                }
            }

            DB::table('friends')->insert([
                'name' => $dataForm['nameFri'] ? $dataForm['nameFri'] : '',
                'email' => $dataForm['email'],
                'phone_number' => $dataForm['phone'] ? $dataForm['phone'] : '',
                'gender' => ($dataForm['checkMale'] == 'true')? 1: 0,
                'address_city_id' => $dataForm['idCity'],
                'tags' => $dataForm['nameTag'],
                'cv_url' => isset($filename) ? $filename : '',
                'email_receive_flg' => 0,
                'delete_flg' => 1
            ]);
        }
        $emails = $dataForm['email'];

        Mail::send('vendor/mail/html/scouter.messelect', ['link' => '/' . $user->id], function ($message) use ($request, $emails)
        {
            $message->from('scouter@scouter.com', 'Scouter');
            $message->to($emails);
            $message->subject('New Email From Scouter');
        });
        
        echo json_encode($json);
        exit;
    }
}
