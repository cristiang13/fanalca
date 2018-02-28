<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

use Illuminate\Foundation\Auth\RegistersUsers;

class UsersController extends Controller
{



   use RegistersUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= DB::table('users')->get();
      //  dd($users);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      $rules = [
        'dni' => 'required|max:255|unique:users',
        'first_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()){
          return back()->withInput()->withErrors($validator);
      }else {
        $data = $request->all();
    // dd($data);
        if(empty($data['last_name'])){
          $data['last_name']='null';
        }
        if (empty($data['last_lastname'])) {
          $data['last_lastname']='null';
        }


      //  $usuario= User::create($data);
        //dd($usuario);
        //$usuario->save();

        $user= User::where('dni', $data['dni'])->first();
        if (isset($user)) {
          $msg='usuario registrado';
        return redirect('users')->with('msg', 'Usuario registrado');
        }else {
        return redirect('users')->with('msg', 'Usuario no registrado');
        }

      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = DB::table('users')->where('id',$id)->get();
       //dd($user);
       return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::where('id',$id)->first();
      //$user= User::findOrFail($id);


        $user->first_name= $request->first_name;
        $user->last_name= $request->last_name;
        $user->first_lastname= $request->first_lastname;
        $user->last_lastname= $request->last_lastname;
        $user->cellphone= $request->cellphone;
        $user->email= $request->email;
        $aux = new User;
        $aux = $user;
        $event= $aux->save();


      //  $user->fill($request)->save();
      if ($event) {
          return back()->with('msg', 'actulización exitosa');
      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      User::findOrFail($id)->delete();
      return redirect('users');
    }

    public function password(){

       return view('editPassword');
   }

    public function updatePassword(Request $request){
        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ];

        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect('updatePassword')->withErrors($validator);
        }
        else{
            if (Hash::check($request->mypassword, Auth::user()->password)){
                $user = new User;
                $user->where('email', '=', Auth::user()->email)
                     ->update(['password' => bcrypt($request->password)]);
                return redirect('updatePassword')->with('status', 'Password cambiado con éxito');
            }
            else
            {
                return redirect('updatePassword')->with('message', 'Credenciales incorrectas');
            }
        }
    }
}
