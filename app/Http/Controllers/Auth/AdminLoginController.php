<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Admin;
use Auth;
use Hash;
use Session;
class AdminLoginController extends Controller
{

	public function __construct(){
      $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request){
    	//Validate login form data
    	$validator = Validator::make($request->all(),[
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);
    	if($validator->fails()){
    		$errors = $validator->errors();
    		return redirect(route('admin.login'))->withErrors($errors)->withInput();
    	}else {
    		$email = $request->get('email');
    		$password = $request->get('password');
    		$remember = $request->get('remember');
    		if(Auth::guard('admin')->attempt(['email' => $email,'password' => $password],$remember)){
    			$admins = DB::table('admins')->where('email',$email)->first();
    			$request->session()->put('admins', $admins);
    			return redirect(route('admin.dashboard'));
    		}else{
    			return redirect(route('admin.login'))->with('fail','Invalid Login')->withInput($request->only($email,$remember));
    		}
    	}
    }

    //lluminate\Foundation\Auth\AuthenticatesUsers

   /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(){
    	auth('admin')->logout();
    	return redirect(route('admin.login'));
    }
}
