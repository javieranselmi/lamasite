<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class AuthenticationController extends AdminController
{

    public function __construct(){
        if(\Illuminate\Support\Facades\Request::route()->getName() != 'admin_logout' && Auth::check()){
            return redirect()->route("admin_dashboard");
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            return redirect()->route('admin_dashboard');
        }
        return view('admin.login');
    }

    public function authenticate(){
        $email = Input::get('email');
        $password = Input::get('password');
        $remember = Input::get('remember-me');
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect()->route('admin_dashboard');
        }
        return view('admin.login', ['failed' => true]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin_login');
    }
}
