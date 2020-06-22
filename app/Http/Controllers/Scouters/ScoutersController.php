<?php

namespace App\Http\Controllers\Scouters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cities;
use App\Models\Scouters;
use App\Models\Tags;
use App\Models\Friends;
use App\Models\Applies;
use App\Models\Candidates;
use App\Models\Jobs;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Hash;
use Storage;

class ScoutersController extends Controller
{
    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('front/scouters.index', compact('user'));
    }

    /**
    * Description: Profile update infomation user scouter
    * Function: profile()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function profile(Request $request){
        try {
            $allRequest = $request->all();
            $user = Auth::user();
            $cities = Cities::all();
            
            if ($request->isMethod('post')) {
                DB::table('users')->where('id', $user->id)->update(['name' => $allRequest['user_name']]);
                DB::table('scouters')->where('member_id', $user->id)
                ->update([
                    'id_card' => $allRequest['card_number'],
                    'birth_day' => date("Y-m-d", strtotime($allRequest['date_of_birth'])),
                    'address' => $allRequest['address_user'],
                    'phone_number' => $allRequest['phone_number'],
                    'address_city_id' => $allRequest['cities']
                ]);
            }
            $scouter = DB::table('scouters')->select()->where('member_id', $user->id)->first();
            $birth_day = date("d-m-Y", strtotime($scouter->birth_day));
            $city = DB::table('cities')
            ->join('scouters', 'cities.id', '=', 'scouters.address_city_id')
            ->select('cities.id', 'cities.name_vi')
            ->where('scouters.member_id', $user->id)->first();
            $username = $user->name;

            return view('front/scouters.profile', compact('user', 'cities', 'scouter', 'birth_day', 'city', 'username'));
        } catch (Exception $e) {
        
        }
    }

    /**
    * Description: Account view infomation user scouter
    * Function: account()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function account(Request $request){
        $allRequest = $request->all();
        $user = Auth::user();
        $file = 0;
        $scouter = DB::table('scouters')->select('email_receive_flg')->where('member_id', $user->id)->first();
        $mail = $user->email;

        if(is_file(public_path('UserProfiles/' . $user->id . '/img/profile-image.png'))){
            $file = 1;
        }
        
        return view('front/scouters.account', compact('user', 'scouter', 'mail', 'file'));
    }

    /**
    * Description: Account update email, checked setting user scouter
    * Function: accountAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function accountAjax(Request $request){
        $json = [
            'status' => 'success',
            'data'   => null
        ];
        $user = Auth::user();
        $allRequest = $request->all();
        $userEmail = DB::table('users')->select('email')->where('email', $allRequest['email'])->first();

        if($allRequest['check'] == "true"){
            DB::table('users')->where('id', $user->id)->update(['email' => $allRequest['email']]);
            DB::table('scouters')->where('member_id', $user->id)->update(['email_receive_flg' => 1]);
        } else {
            DB::table('users')->where('id', $user->id)->update(['email' => $allRequest['email']]);
            DB::table('scouters')->where('member_id', $user->id)->update(['email_receive_flg' => 0]);
        }

        echo json_encode($json);
        exit;
    }

    /**
    * Description: Account update password user scouter
    * Function: editPassAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function editPassAjax(Request $request){
        $json = [
            'status' => 'success',
            'data'   => null
        ];
        $ms = 0;
        $allRequest = $request->all();
        $user = Auth::user();
        
        if (Hash::check($allRequest['current_pass'], $user->password)){
            if(!empty($allRequest['new_pass'])){
                if ($allRequest['new_pass'] == $allRequest['confirm_pass']) {
                    $user->password = Hash::make($allRequest['new_pass']);
                    $user->save();
                    $ms = 1;
                }
                else {
                    $ms = 2;
                }
            }
        } else {
            if(!empty($allRequest['current_pass'])){
                $ms = 3;
            }
        }
        $json['data']['ms'] = $ms;

        echo json_encode($json);
        exit;
    }

    /**
    * Description: Get full path file image user scouter
    * Function: getPathAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function getPathAjax(Request $request){
        $json = [
            'status' => 'success',
            'data'   => null
        ];
        $allRequest = $request->all();
        $fileContent = pathinfo($allRequest['file']->getRealPath());
        $json['filieContent'] = $fileContent;

        echo json_encode($json);
        exit;
    }

    /**
    * Description: Account upload file user scouter
    * Function: fileUploadAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function fileUploadAjax(Request $request){
        $json = [
            'status' => 'success',
            'data'   => null
        ];
        $allRequest = $request->all();
        $user = Auth::user();
        $filename = $allRequest['file']->getClientOriginalName();
        $file_tmp_name = $allRequest['file']->getRealPath();
        $dir = public_path('UserProfiles/' . $user->id . '/img');
        $image = 'profile-image.png';
        
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $allowed = ['png', 'jpg', 'jpeg'];
        
        if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
            throw new InternalErrorException('Error Processing Request.', 1);
        } elseif (is_uploaded_file($file_tmp_name)) {
            move_uploaded_file($file_tmp_name, $dir . '/' . $image);
        }

        echo json_encode($json);
        exit;
    }

    /**
    * Description: Add friend, view lists friend user scouter
    * Function: friend()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function friend(Request $request){
        try {
            $allRequest = $request->all();
            $user = Auth::user();
            $cities = Cities::all();
            $tags = Tags::all();
            
            if ($request->isMethod('post')) {
                $friendEmail = DB::table('friends')->select('email')->where('email', $allRequest['email_friend'])->first();
                
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
                        'name' => $allRequest['user_name'] ? $allRequest['user_name'] : '',
                        'email' => $allRequest['email_friend'],
                        'phone_number' => $allRequest['phone_number'] ? $allRequest['phone_number'] : '',
                        'gender' => $allRequest['malefe'],
                        'address_city_id' => $allRequest['cities'],
                        'tags' => $allRequest['tag_friend'],
                        'cv_url' => isset($filename) ? $filename : '',
                        'email_receive_flg' => 0,
                        'delete_flg' => 1
                    ]);
                }
            }
            $friends = Friends::all();
            
            return view('front/scouters.friend', compact('user', 'cities', 'tags', 'friends'));
        } catch (Exception $e) {

        }
    }

    /**
    * Description: Edit friend, view lists friend user scouter
    * Function: update()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    * @param: $id friend
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id){
        try {
            $allRequest = $request->all();
            $user = Auth::user();
            $cities = Cities::all();
            $tags = Tags::all();

            if ($request->isMethod('post')) {
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

                DB::table('friends')->where('id', $id)->update([
                    'name' => $allRequest['user_name'],
                    'email' => $allRequest['email_friend'],
                    'phone_number' => $allRequest['phone_number'],
                    'gender' => $allRequest['malefe'],
                    'address_city_id' => $allRequest['cities'],
                    'tags' => $allRequest['tag_friend'],
                    'cv_url' => isset($filename) ? $filename : '',
                ]);
            }
            $friend = DB::table('friends')->select()->where('id', $id)->first();
            $city = DB::table('cities')
            ->join('friends', 'cities.id', '=', 'friends.address_city_id')
            ->select('cities.id', 'cities.name_vi')
            ->where('friends.id', $id)->first();
            
            return view('front/scouters.edit', compact('user', 'cities', 'friend', 'city', 'tags'));
        } catch (Exception $e) {

        }
    }

    /**
    * Description: Remove friends list checkbox
    * Function: removeCheckAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function removeCheckAjax(Request $request){
        $json = [
            'status' => 'success',
            'data' => null
        ];
        $allRequest = $request->all();
        $user = Auth::user();

        if($allRequest['dataId'][0] == 'select-all'){
            DB::table('friends')->whereIn('id', $allRequest['dataId'])->update(['delete_flg' => 0]);
        } else {
            DB::table('friends')->whereIn('id', $allRequest['dataId'])->update(['delete_flg' => 0]);
        }

        echo json_encode($json);
        exit;
    }

    /**
    * Description: Remove friend item
    * Function: deleteAjax()
    * @author: SonNguyen
    * @param: \Illuminate\Http\Request  $request
    */
    public function deleteAjax(Request $request){
        $json = ['status' => 'success', 'data' => null];
        $allRequest = $request->all();
        DB::table('friends')->where('id', $allRequest['id'])->update(['delete_flg' => 0]);
        echo json_encode($json);
        exit;
    }

    /**
    * Description: 
    * Function: introjob()
    * @author: SonNguyen
    */
    public function introjob(){
    }

    /**
    * Description: View lists friend job introduct
    * Function: intro()
    * @author: SonNguyen
    * @return: list applies of user intro
    */
    public function intro(){
        $user = Auth::user();

        $applies = DB::table('applies')
        ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
        ->join('jobs', 'applies.job_id', '=','jobs.id')
        ->join('scouters', 'applies.scouter_id', '=','scouters.id')
        ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
        ->join('users', 'users.id', '=','scouters.member_id')
        ->select(
            'candidates.name as canName',
            'candidates.tags as canTag',
            'jobstatus.name as stName',
            'applies.id'
        )->where('member_id', $user->id)->get();

        return view('front/scouters.introlist', compact('user', 'applies'));
    }

    /**
    * Description: View detail status friend
    * Function: introDetail()
    * @author: SonNguyen
    * @return: Detail status friend
    */
    public function introDetail($id){
        $user = Auth::user();
        $applie = DB::table('applies')
        ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
        ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
        ->select(
            'candidates.name as canName',
            'jobstatus.name as stName'
        )->where('applies.id', $id)->first();
        
        return view('front/scouters.introdetail', compact('user', 'applie'));
    }

    /**
    * Description: Search by name or job title user sample
    * @author: SonNguyen
    * @return: List user sample name or job title.
    */
    public function search(){
        $user = Auth::user();
        $name = Input::get('name');

        if($name != ''){
            $app_search = DB::table('applies')
            ->join('candidates', 'applies.candidate_id', '=', 'candidates.id')
            ->join('jobs', 'applies.job_id', '=','jobs.id')
            ->join('scouters', 'applies.scouter_id', '=','scouters.id')
            ->join('jobstatus', 'applies.jobstatus_id', '=','jobstatus.id')
            ->join('users', 'users.id', '=','scouters.member_id')
            ->select(
                'candidates.name as canName',
                'candidates.tags as canTag',
                'jobstatus.name as stName'
            )
            ->where('member_id', $user->id)
            ->where('candidates.name','LIKE','%'.$name.'%')
            ->orWhere('candidates.tags','LIKE','%'.$name.'%')->get();
            
            return view('front/scouters.search', compact('user', 'app_search'));
        }
    }

    /**
    * Description: View list bonus of user sample
    * Function: bonus()
    * @author: SonNguyen
    * @return: List bonus user sample.
    */
    public function bonus(){
        $user = Auth::user();
            
        return view('front/scouters.bonus', compact('user'));
    }
}
