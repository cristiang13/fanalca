<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/users';



    /**
     * Create a new controller instance.
     *
     * @return void
    * public function __construct()
    *   {
    *       $this->middleware('guest');
      * }
     */
  //  toca quitarlo por que inhabilita la opcion de register del view users.index


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'dni' => 'required|max:255|unique:users',
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
      //dd($data);
      if(empty($data['last_name'])){
        $data['last_name']='null';
      }
      if (empty($data['last_lastname'])) {
        $data['last_lastname']='null';
      }
        return User::create([
            'dni' => $data['dni'],
            'first_name' => $data['name'],
            'last_name'=>$data['last_name'],
            'first_lastname'=>$data['first_lastname'],
            'last_lastname'=>$data['last_lastname'],
            'cellphone'=>$data['cellphone'],
            'role'=>$data['role'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

        ])->with('msg', 'Usuario registrado');
    }
}
