<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(){
        if(Auth::check()){
            return Redirect::to('admin/dashboard');
        }
        return view('auth.login');
    }


    public function authLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'username'  => 'required|string',
            'password'  => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = [
            'email'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { 
            return Redirect::to('admin/dashboard');
        }

        return Redirect::to('admin/login')->with('errorLogin', 'Email or Password wrong.');
    }

    public function authLogout(){
        Auth::logout();
        return Redirect::to('admin/login');
    }

}
