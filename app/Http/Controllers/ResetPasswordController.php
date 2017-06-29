<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\ResetPasswordToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{

    public function index() {
        return view('recover');
    }

    public function recover(){
        $email = Input::get('email');
        $Users = \App\User::where('email', $email)->get();
        if($Users->count() > 0){
            $User = $Users->get(0);
            $ResetPasswordTokens = \App\ResetPasswordToken::where('email', $User->email)->get();
            if($ResetPasswordTokens->count() > 0){
                foreach ($ResetPasswordTokens as $PasswordToken){
                    $PasswordToken->delete();
                }
            }
            $PasswordToken = \App\ResetPasswordToken::create(['email' => $User->email, 'token' => Hash::make($User->email . time())]);
            Mail::to($User)->send(new ResetPassword($PasswordToken));
            return view('recover_email_sent');
        }
        return view('recover', ['failed' => true]);
    }

    public function show_reset_password_form($token){
        $ResetPasswordToken = \App\ResetPasswordToken::where('token', $token)->get();
        if($ResetPasswordToken->count() > 0){
            return view('reset_password', ['token' => $token]);
        }
        return redirect()->route('login');
    }

    public function reset_password($token, Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()){
            return view('reset_password', ['failed' => true, 'error' => 'Las contrase&ntilde;as no coinciden.', 'token' => $token]);
        }
        $ResetPasswordToken = \App\ResetPasswordToken::where('token', $token)->get();
        if($ResetPasswordToken->count() > 0){
            $ResetPasswordToken = $ResetPasswordToken->get(0);
            $User = \App\User::where('email', $ResetPasswordToken->email)->get();
            if($User->count() > 0){
                $User = $User->get(0);
                $User->password = Hash::make(Input::get('password'));
                $User->save();
                $ResetPasswordToken->delete();
                return view('reset_password_successful');
            }
        }
        return redirect()->route('login');
    }
}
