<?php

namespace App\Http\Controllers;


use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()){
            $name = Input::get('name');
            $email = Input::get('email');
            $message = Input::get('message');

            if(!empty($name) && !empty($email) && !empty($message)){
                Mail::to(env('CONTACT_EMAIL'))->send(new Contact($name, $email, $message));
                return response()->json(['status' => 'success']);
            }
        }
        abort(400);
    }
}
