<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends AdminController
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
        $News = \App\News::first();

        $ViewParameters = ['news' => $News];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.news.news_edit', $ViewParameters);
    }

    public function edit_news(Request $request){
        $validator = Validator::make($request->all(), [
            'news_content' => 'required',
        ]);

        if($validator->fails()){
            return view('admin.news.news_edit', ['failed' => true, 'errors' => $validator->errors()]);
        }

        $News = \App\News::first();

        $Text = Input::get('news_content');

        if(is_null($News)){
            \App\News::create(['text' => $Text]);
        }else{
            $News->phone_two = $Text;
            $News->save();
        }

        return redirect()->route('admin_news_edit', ['status' => 'success', 'message' => 'Novedad Editada']);
    }
}
