<?php

namespace App\Http\Controllers\Cms;

use App\Models\Users;
use App\Models\Scouters;
use App\Models\Companies;
use App\Models\Cities;
use App\Models\Applies;
use App\Models\Candidates;
use App\Models\Countries;
use Session;
use DateTime;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;   
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct(\Maatwebsite\Excel\Exporter $excel)
     {
        $this->middleware('auth');
        $this->excel = $excel;
    }
    /**
     * Description: Show all user and Paginate total user.
     * Author: VPDuy
     * Version: V.1
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $users = Users::orderBy('id', 'desc')->where('delete_flg',0)->paginate(10);
        return view('cms/users.index',compact('users',$users));
    }

    /**
     * Description: Display form add user.
     * @author: VPDuy
     * @version: V.1
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms/users.create');

    }

    /**
     * Description: Store a newly created resource in storage.
     * received all requet from create form
     * @author: VPDuy
     * @version: V.1
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
            $allUser = $request->all();
            $name = $allUser['name'];
            $email = $allUser['email'];
            $password = $allUser['password'];
            $created_at = now();
            $modified_at = now(); 

            //save DB
            $dataInserdb = array(
                'name' => $name,
                'email' => $email,
                'remember_token' => Str::random(60),
                'password' => bcrypt($password),
                'role' => 3,
                'delete_flg' => 0,
                'created' => $created_at,
                'modified' => $modified_at,
            );
            $user = new Users;
            $user->insert($dataInserdb);
            //get message from config/master.php
            $mess = config('master.MESSAGE_NOTIFICATION.MSG_103');        
            return redirect()->action('Cms\UsersController@index')->with('message',$mess);
        } catch (Exception $e) {
            return redirect()->action('Cms\UsersController@index')->with('message',$e);
        }
        
    }

    /**
     * Description: View info user by ID
     * @author: VPDuy
     * @version: 1.0
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    
    public function show($id) {
        $data = [ 
            'user' => Users::where('id', $id)->firstOrFail()
        ];

        return view('/cms/users.show', $data);
    }
    /**
     * Description :Show info user by ID and check ROLE user.
     * @author: VPDuy
     * @version: 1.0
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        try {
           $checkData      = new Users;
           $checkComp      = new Companies;
            //get all cities
            $roles          = Cities::all();
            //get all country
            $contrys        = Countries::all();
            
            //get workingDay
            $workingDays    = config('master.WORKING_DAYS');
            //get OVERTIME_TYPES
            $overtimeTypes  = config('master.OVERTIME_TYPES');
            //get COMPANY_TYPES
            $companyTypes   = config('master.COMPANY_TYPES');
           
            //checl role users
            $getRole        = $checkData->find($id);            
            $getcityid = DB::table('companies')->select('*')->where('member_id', $getRole->id)->first();
            $getaddressid = DB::table('scouters')->select('*')->where('member_id', $getRole->id)->first();
           
            //If role is scouter show data table user and join with table scouter
                if($getRole->role==2){
                            $data = [    
                            'user'       =>  Users::where('id', $id)->firstOrFail(),
                            'companies'  =>  Companies::with(['users'])->where('member_id', $id)->firstOrFail(),
                            'countries'  =>  Countries::with(['Companies'])->where('id', $getcityid->country_id)->firstOrFail(),
                        ];
                    return view('/cms/users.editCompanies', $data, compact('contrys','workingDays','overtimeTypes','companyTypes'));
                    }
               if($getRole->role==1){
                        $data = [ 
                        'user'     =>  Users::where('id', $id)->firstOrFail(),
                        'scouters' =>  Scouters::with(['users'])->where('member_id', $id)->firstOrFail(),
                        'cities'   =>  Cities::with(['Scouters'])->where('id', $getaddressid->address_city_id)->firstOrFail(),
                        
                    ];
                        return view('/cms/users.editScouter',$data, compact('roles'));
                    }
                      //If role is companies show data table user and join with table companies
                  if($getRole->role==3){
                    $data = [ 
                      'user' =>  Users::where('id', $id)->firstOrFail()
                  ];

                  return view('/cms/users.edit',$data);
                } 
        } catch (Exception $e) {
            return redirect()->action('Cms\UsersController@index')->with('message',$e);
        }
        
    }

    /**
     * Description: Update info user(Scouters or employer or admin)  .
     * Data received from in form edit .
     * @author: VPDuy
     * @version: V.1
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $Users)
    {
        
            //Validate
        $request->validate([
            'name' => 'required|min:3'
        ]);
        
        //Check info input
        $allUser    = $request->all();
        $name       = $allUser['name'];
        $idUser     = $allUser['id'];
        //check id and role user và save result update
        //table user
        $user       = new Users;  
        $getUserID  = $user->find($idUser);  
        if($getUserID->role == 1){
           //table Scouters
            $id_card        = $allUser['id_card'];
            $birth_day      = $allUser['birth_day'];
            $phone_number   = $allUser['phone_number'];
            $address        = $allUser['address'];
            $address_city_id= $allUser['address_city_id'];
            $email_receive_flg= $allUser['email_receive_flg'];            
            DB::beginTransaction();
            try {
                DB::table('scouters')
                ->where('member_id', $idUser)
                ->update([
                    'id_card'      => $id_card,
                    'birth_day'    => date("Y-m-d H:i:s", strtotime($birth_day)),
                    'phone_number' => $phone_number,
                    'address'      => $address,
                    'address_city_id' => $address_city_id,
                    'email_receive_flg' => $email_receive_flg,
                    'delete_flg'   => 0,
                ]);
                DB::table('users')
                ->where('id', $idUser)
                ->update([
                    'name'        => $name,
                    'delete_flg'  => 0,
                    'modified'    => now(),   
                ]);
                DB::commit();
                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Cms\UsersController@index')->with('message',$mess);
            }       
         catch (Exception $e) {
             DB::rollBack();
             return redirect()->action('Cms\UsersController@index')->with('message',$e);
          }
          
        }
        elseif($getUserID->role == 2){
            //table companies
            $nameComp       = $allUser['name'];
            $representative = $allUser['representative'];
            $phoeComp       = $allUser['phone_number'];
            $addressComp    = $allUser['address'];
            $web_url        = $allUser['web_url'];
            $members        = $allUser['members'];
            $foundation_date= $allUser['foundation_date'];
            $country_id     = $allUser['country_id'];
            $work_from      = $allUser['work_from'];
            $work_to        = $allUser['work_to'];
            $overtime_id    = $allUser['overtime_id'];
            $company_type_id= $allUser['company_type_id'];
            //$address_city_id= $allUser['address_city_id'];
            $description    = $allUser['description'];
            
            //check upload banner or avatar
            if($request->hasFile('logo_url')||$request->hasFile('banner_url')){
                $banner             = $request->file('banner_url');
                $logo               = $request->file('logo_url');
                $filename_banner    = time() . '.' . $banner->getClientOriginalExtension();
                $filename_logo      = time() . '.' . $logo->getClientOriginalExtension();

                $bannerPath         = public_path('/files/banner/');
                $logoPath           = public_path('/files/avatar/company/');   
                // upload image in folder
                $banner->move($bannerPath,$filename_banner);
                $logo->move($logoPath,$filename_logo);
                DB::table('companies')
                ->where('member_id', $idUser)
                ->update([
                    'country_id'            => $country_id,
                    'name'                  => $nameComp,
                    'work_from'             => $work_from,
                    'work_to'               => $work_to,
                    'company_type_id'       => $company_type_id,
                    'overtime_id'           => $overtime_id,
                    'address'               => $addressComp,
                    //'address_city_id'       => $address_city_id,
                    'phone_number'          => $phoeComp,
                    'representative'        => $representative,
                    'web_url'               => $web_url,
                    'members'               => $members,
                    'foundation_date'       => date("Y-m-d H:i:s", strtotime($foundation_date)),  
                    'description'           => $description,
                    'banner_url'            => $filename_banner,
                    'logo_url'              => $filename_logo,
                    'delete_flg'            => 0,
                    'modified'              => now(),
                ]);

                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Cms\UsersController@index')->with('message',$mess);
            }
            else{
             $banner       = $allUser['banner'];
             $logo         = $allUser['logo'];
             DB::table('companies')
             ->where('member_id', $idUser)
             ->update([

                'country_id'            => $country_id,
                'name'                  => $nameComp,
                'work_from'             => $work_from,
                'work_to'               => $work_to,
                'company_type_id'       => $company_type_id,
                'overtime_id'           => $overtime_id,
                'address'               => $addressComp,
                //'address_city_id'       => $address_city_id,
                'phone_number'          => $phoeComp,
                'representative'        => $representative,
                'web_url'               => $web_url,
                'members'               => $members,
                'foundation_date'       => date("Y-m-d H:i:s", strtotime($foundation_date)),  
                'description'           => $description,
                'banner_url'            => $banner,
                'logo_url'              => $logo,
                'delete_flg'            => 0,
                'modified'              => now(),
            ]);

             $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
             return redirect()->action('Cms\UsersController@index')->with('message',$mess);
         }

             }
             elseif($getUserID->role == 3){
                DB::table('users')
                ->where('id', $idUser)
                ->update([
                    'name'        => $name,
                    'delete_flg'  => 0,
                    'modified'    => now(),   
                ]);

                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Cms\UsersController@index')->with('message',$mess);
            }
            else{
                $mess = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_202'); 
                return redirect()->action('Cms\UsersController@index')->with('message',$mess);
            }
        
    }
 /**
     * Description: Update account
     * Check user id 
     * @version :V.1
     * @author: VPDuy
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
 public function updateAccount(Request $request)
 {
    try {
           //$user = Auth::user();
     $user          = Users::find(auth()->user()->id);
         //$user = new Users;
     $dataChange    = $request->all();
     $email         = $dataChange['email'];
     $newPassword   = $dataChange['newPassword'];   
     $id            = $dataChange['id'];

     if($user->role == 1){                              
                // Logic for user upload of avatar
                // tạo link php artisan files:link
        $email_receive_flg = $dataChange['email_receive_flg'];
        if($request->hasFile('avatar_url')){

            $avatar = $request->file('avatar_url');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = public_path('/files/avatar/scouter/');  
                    // upload image in folder
            $avatar->move($destinationPath,$filename);
            DB::beginTransaction();
            try {
                DB::table('users')
                ->where('id', $id)
                ->update([
                    'email'        => $email,
                    'password'     => bcrypt($newPassword),
                    'modified'     => now(),   
                ]); 
                        //Save DB
                DB::table('scouters')
                ->where('member_id', $id)
                ->update([
                    'avatar_url'        => $filename,
                    'email_receive_flg' => $email_receive_flg,
                    'modified'          => now(),
                ]);
                DB::commit();
                $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
                return redirect()->action('Cms\UsersController@index')->with('message',$mess);
            }
            catch (Exception $e) {
             DB::rollBack();
             return redirect()->action('Cms\UsersController@index')->with('message',$e);
          }
        }
        else
        {   
            $image         = $dataChange['avatar'];
            DB::beginTransaction();
            try {
                DB::table('users')
                ->where('id', $id)
                ->update([
                    'email'        => $email,
                    'password'     => bcrypt($newPassword),
                    'modified'     => now(),   
                ]); 
                        //Save DB
                DB::table('scouters')
                ->where('member_id', $id)
                ->update([
                    'avatar_url'        => $image,
                    'email_receive_flg' => $email_receive_flg,
                    'modified'          => now(),
                ]);
                DB::commit();
                $mess_v2 = config('master.MESSAGE_NOTIFICATION.MSG_102');
                return redirect()->action('Cms\UsersController@index')->with('message',$mess_v2);
        }
            catch (Exception $e) {
             DB::rollBack();
             return redirect()->action('Cms\UsersController@index')->with('message',$e);
          }
    }

    }
    elseif($user->role == 2){

            //Save DB
        DB::table('users')
        ->where('id', $id)
        ->update([
            'email'        => $email,
            'password'     => bcrypt($newPassword),
            'modified'     => now(),
        ]);

        $mess = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
        return redirect()->action('Cms\UsersController@index')->with('message',$mess);
    }
    elseif($user->role == 3){        
            //Save DB
        DB::table('users')
        ->where('id', $id)
        ->update([
            'email'        => $email,
            'password'     => bcrypt($newPassword),
            'modified'     => now(),
        ]);

        $message = config('master.MESSAGE_NOTIFICATION.MSG_102'); 
        return redirect()->action('Cms\UsersController@index')->with('message',$message);
    }
    else{

        $mess_v3 = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_202'); 
        return redirect()->action('Cms\UsersController@index')->with('message',$mess_v3);
      }
    } catch (Exception $e) { 
        return redirect()->action('Cms\UsersController@index')->with('message',$e);
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
     * Description: Update updatePassword
     * Check info user by ID and update new password
     * @version: V.1
     * @author: VPDuy
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
     public function updatePassword(Request $request)
     {
        //$user = Auth::user();
         $user = Users::find(auth()->user()->id);
       // $user = new Users;
         $dataChange = $request->all();
         $curPassword = $dataChange['curPassword'];
         $newPassword = $dataChange['newPassword'];
         $id = $dataChange['id'];
       //check currenPass and new Pass
         if(Hash::check($dataChange['curPassword'], $user->password)){
            $user_id =  $id;
            $user->password = bcrypt($newPassword);
            $user->modified = now();
            $user->save();

            return redirect()->action('Cms\UsersController@index');
        }
        else
        {
         return redirect()->action('Cms\UsersController@updatePassword');
     }

 }
    /**
     * Create function export csv file.
     * @author: VPDuy to be countinue.
     * @return void       
     * @version: V.1
     */
    public function exportFile(){
        $headers = [

            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv;charset=UTF-8'
        ,   'Content-Encoding' => 'UTF-8'
        ,   'Content-Disposition' => 'attachment; filename=galleries.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
                ];

                $list = Users::all()->toArray();
                $columns = array(`name`);
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
     * Description: Search by name or email or role or dateCreated 
     * Input name or email.   
     * @author: VPDuy
     * @version:V.1
     * @result: info user sample name or email.
     */
    public function search(){
        $name = Input::get('name');
        $email = Input::get('email');
        $role = Input::get('role');
        $created_from = Input::get('created_from');
        $created_to = Input::get('created_to');
        $cre_from = date('Y-m-d', strtotime($created_from));
        $cre_to = date('Y-m-d', strtotime($created_to));
        $datenow = date('Y-m-d', strtotime(now()));
        
        //Query
        $query =  DB::table('users')->where('users.delete_flg', 0);

        $is_first = false;
        if ($name != "") {
            if($is_first){
                $query->orWhere('name','LIKE','%'.$name.'%');
            }else{
                $is_first = True;
                $query->where('name','LIKE','%'.$name.'%');
            }            
        } 
        if ($email != "") {
            if ($is_first)
                $query->orWhere('email','LIKE','%'.$email.'%');
            else{
                $is_first = True;
                $query->where('email','LIKE','%'.$email.'%');
            } 
        }
        if ($role != "") {
            if ($is_first)
                $query->orWhere('role','LIKE','%'.$role.'%');
            else {
                $is_first = True;
                $query->where('role','LIKE','%'.$role.'%');
            }     
        }
        if ($cre_from != $datenow) {
            if ($is_first){
               $query->orWhereBetween('users.created',[$cre_from, $cre_to]);
            }
            else{
                $is_first = True;
                $query->whereBetween('users.created', [$cre_from, $cre_to]);
            }
        }
        if($name == "" && $email == "" && $role == "" && $cre_from == "1970-01-01" && $cre_to == "1970-01-01"){
            if($is_first){
                $query->orWhere('name','LIKE','%'.$name.'%');
            }else{
                $is_first = True;
                $query->where('name','LIKE','%'.$name.'%');
            }  
        }  
        
        $user = $query->where('users.delete_flg', 0)->get();    
        if(count($user)>=0){ 
            $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_105');
            return view('cms/users/search')->withDetails($user)                
                 ->with('message',$mess_v3);
             }
        else{ 
            $mess_v2 = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_203');
            return redirect()->action('Cms\UsersController@search')->with('message',$mess_v2);
            }      

    }
    /**
     * Description: Remove the specified resource from storage.
     * @param  \App\Users  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Users::find($id)){
            $user = Users::find($id);
            //$user->delete();
            DB::table('users')
            ->where('id', $id)
            ->update([
                'delete_flg'   => 1,
                'modified'     => now(),
            ]);
            $mess_v2 = config('master.MESSAGE_NOTIFICATION.MSG_104'); 
            return redirect()->action('Cms\UsersController@index')->with('message',$mess_v2);
        } else {
         $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_202'); 
         return redirect()->action('Cms\UsersController@index')->with('message',$mess_v3); 
     }
 }
}
