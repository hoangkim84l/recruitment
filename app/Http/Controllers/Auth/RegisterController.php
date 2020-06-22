<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Scouters;
use App\Models\Cities;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(url()->previous() == request()->root() . '/scouters/dang-ky'){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 1,
                'delete_flg' => 0,
                'created' => date('Y-m-d H-m-s'),
                'modified' => date('Y-m-d H-m-s')
            ]);
            
            DB::table('scouters')->insert([
                'member_id' => $user['id'],
                'delete_flg' => 0,
                'created' => date('Y-m-d H-m-s'),
                'modified' => date('Y-m-d H-m-s'), 
                'id_card' => 1,
                'birth_day' => date('Y-m-d H-m-s'),
                'address' => 'Number, Street, Ward, District',
                'address_city_id' => 1,
                'phone_number' => 0,
                'email_receive_flg' => 1
            ]);
            $this->redirectTo = '/scouters';
            return $user;
        } else if(url()->previous() == request()->root() . '/employers/dang-ky') {
            $user = User::create([
                'name' =>  $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 2,
                'delete_flg' => 0,
                'created' => date('Y-m-d H-m-s'),
                'modified' => date('Y-m-d H-m-s')
            ]);
            DB::table('companies')->insert([
                'member_id' => $user['id'],
                'address' => $data['company_address'],
                'address_city_id' => $data['company_address_city'],
                'phone_number' => $data['company_phone'],
                'delete_flg' => 0,
                'created' => date('Y-m-d H-m-s'),
                'modified' => date('Y-m-d H-m-s'),
                'country_id' => 1,
                'name' => $data['name'],
                'company_type_id' => 1
            ]);
            $this->redirectTo = '/companies';
            return $user;
        }
    }

    /**
     * Registration 
     */
    public function employerRegistration(Request $request)
    {
        if ($request->isMethod('get')) {
        	return $this->get_employerRegistration();
    	} else if ($request->isMethod('put')) {
    		return $this->put_employerRegistration($request);
    	} else if ($request->isMethod('post')) {
    		return $this->post_employerRegistration($request);
    	}
    }

    public function get_employerRegistration()
    {
        $cities          = Cities::all();
        $companyTypes   = config('master.COMPANY_TYPES');
        return view('auth.registere', compact('cities','companyTypes'));
    }

    public function put_employerRegistration(Request $request)
    {

    }

    public function post_employerRegistration(Request $request)
    {

    }
}
