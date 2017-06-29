<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContactController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contact = \App\ContactInformation::first();

        $ViewParameters = ['contact' => $Contact];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.contact.contact_edit', $ViewParameters);
    }

    public function edit_contact(Request $request){
        $validator = Validator::make($request->all(), [
            'contact_email' => 'required|email',
            'contact_phone_one' => 'required',
            'contact_phone_two' => 'required',
        ]);

        if($validator->fails()){
            return view('admin.contact.contact_edit', ['failed' => true, 'errors' => $validator->errors()]);
        }

        $Contact = \App\ContactInformation::first();

        $ContactEmail = Input::get('contact_email');
        $ContactPhoneOne = Input::get('contact_phone_one');
        $ContactPhoneTwo = Input::get('contact_phone_two');

        if(is_null($Contact)){
            \App\ContactInformation::create(['email' => $ContactEmail, 'phone_one' => $ContactPhoneOne, 'phone_two' => $ContactPhoneTwo]);
        }else{
            $Contact->email = $ContactEmail;
            $Contact->phone_one = $ContactPhoneOne;
            $Contact->phone_two = $ContactPhoneTwo;
            $Contact->save();
        }

        return redirect()->route('admin_contact_edit', ['status' => 'success', 'message' => 'Informacion Editada']);
    }
}
