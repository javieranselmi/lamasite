<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class AuthenticationController extends Controller
{

    public function __construct(){
        parent::__construct();
        if(\Illuminate\Support\Facades\Request::route()->getName() != 'logout' && Auth::check()){
            return redirect()->route("home");
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function authenticate(){
        $email = Input::get('email');
        $password = Input::get('password');
        $remember = Input::get('remember-me');
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $this->metricService->publishUserLogin(Auth::user());
            if(Auth::user()->tac)
                return redirect()->intended('/');
            else
                return redirect()->route('tac');
        }
        return view('login', ['failed' => true]);
    }

    public function tac(){
        return view('tac');
    }

    public function tac_save(){
        $User = Auth::user();
        $User->tac = true;
        $User->save();

        return redirect()->route('home');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
