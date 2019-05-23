<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');

        \Cloudinary::config(array(
            "cloud_name" => "dbpbpokhx",
            "api_key" => "224568426731156",
            "api_secret" => "BrRWdDBVJlaS1f8zmbUNNTk6Ymg"
        ));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_image' => 'https://res.cloudinary.com/dbpbpokhx/image/upload/v1558610104/tmdw3qdx5f5t1itnmz7l.png',
            'status' => '1',
        ]);
    }

    public function adminRegisterForm()
    {
        return view('auth.register-admin');
    }

    public function adminRegister(Request $request)
    {
        // $this->validator($request->all())->validate();

        if(isset($request->profile_image)){
            if($request->file("profile_image")->extension() == "jpg" || $request->file("profile_image")->extension() == "png" || 
            $request->file("profile_image")->extension() == "jpeg"){
                if(($request->file("profile_image")->getSize() / 1000) <= 1024){
                    $upload = \Cloudinary\Uploader::upload($request->file("profile_image"));

                    $admin = Admin::create([
                        'name' => $request['name'],
                        'username' => $request['username'],
                        'password' => Hash::make($request['password']),
                        'profile_image' => $upload["secure_url"],
                        'phone' => $request['phone'],
                    ]);
                    return redirect()->intended('login/admin');                   
                }
                return redirect()->back()->with("warning", "Maximum size is 1MB");
            }
            return redirect()->back()->with("warning", "Only jpg, jpeg, or png are allowed");
        }
        return redirect()->back()->with("warning", "Please fill in all fields");
    }
}
