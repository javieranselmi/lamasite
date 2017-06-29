<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TextsController extends AdminController
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
        $Texts = \App\Text::all();

        $ViewParameters = ['texts' => $Texts];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.texts.texts_list', $ViewParameters);
    }


    public function edit_form($text_id){
        $Text = \App\Text::find($text_id);
        if($Text == null)
            abort(404);

        return view('admin.texts.texts_edit', ['text' => $Text]);
    }

    public function edit_text($text_id, Request $request){
        $Text = \App\Text::find($text_id);
        if($Text == null)
            abort(404);


        $validator = Validator::make($request->all(), [
            'text_name' => 'required',
            'text_content' => 'required',
        ]);

        if($validator->fails()){
            return view('admin.texts.texts_edit', ['failed' => true, 'errors' => $validator->errors(), 'text' => $Text]);
        }

        $TextContent = Input::get('text_content');


        $Text->Content = $TextContent;
        $Text->save();

        return redirect()->route('admin_texts', ['status' => 'success','message' => 'Texto Editado']);
    }
}
