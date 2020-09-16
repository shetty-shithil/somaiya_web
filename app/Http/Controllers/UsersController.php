<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Designation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class UsersController extends Controller
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
    
    // use RegistersUsers;
    protected function showRegistrationForm(){
        $designation =['0'=>'Principal', '1' => 'Vice Principal', '2' => 'Dean Of Academics','3' => 'HOD'];
        $department =['Computer'=> 'Computer', 'IT' => 'IT', 'EXTC' => 'EXTC','ETRX' => 'ETRX'];
        $admin =['0' => 'Yes', '1' => 'No'];
        return view('auth.register',compact('designation','department','admin'));
    }  

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/users';

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
        $data = $request->all();
        return User::create([
            'name' => $data['name'],
            'admin' => $data['admin'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            
        ]);
         return redirect('home')->with('message', 'User registered!');
    }

    protected function register(Request $request)
   {    
    
    $data = $request->all();
    $validator=Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        // 'designation_id' =>['required'],
        // 'department' => ['required'],
    ]);
    if ($validator->fails()) {
        return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();
    }
    // return Designation::create([
    //     'name' => $data['name'],
    //     'department' => $data['department'],
    // ]);
    $designation = new Designation;
    $designation->name = $request->input('name');
    $designation->department = $request->input('department');
    $designation->save();
     User::create([
        'name' => $data['name'],
        'admin' => $data['admin'],
        'email' => $data['email'],
        'designation_id' => $designation->id,
        'password' => Hash::make($data['password']),
        ]);
        // $validation = $this->validator($request->all());
        // if ($validation->fails())  {
        //     return redirect()->back()->with(['errors'=>$validation->errors()->toArray()]);
        // }
        // else{
        //     $user = $this->create($request->all());
        //     Auth::login($user); 
        //     return redirect('/home')->with(['message'=>'Account Successfully Created.']);
        // }
        return redirect('/')->with('success', 'User registered!');

    }

}
