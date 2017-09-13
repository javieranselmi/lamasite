<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NotificationConfigurationsController extends AdminController
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
        $Configurations = \App\NotificationConfiguration::all();

        $ViewParameters = ['notification_configuration' => $Configurations];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.notifications_configurations.notifications_configurations_edit', $ViewParameters);
    }

    public function edit_configurations(Request $request){

        $Configurations = \App\NotificationConfiguration::all();

        foreach($Configurations as $configuration){
            $configuration->value = Input::get($configuration->name, false);
            $configuration->save();
        }

        return redirect()->route('admin_notification_configuration_edit', ['status' => 'success', 'message' => 'Configuracion Editada']);
    }
}
