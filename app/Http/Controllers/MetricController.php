<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class MetricController extends Controller
{
    protected $types = ['counter', 'duration'];
    protected $allowed_resources = [
        'App\\Product',
        'App\\Course',
        'App\\CourseStage',
        'App\\Post',
        'App\\ProductCategory',
        'App\\ProductSubcategory',
        'App\\Like',
        'App\\User',
    ];

    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function send_metric(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'required|in:' . implode(',', $this->types),
                'value' => 'numeric',
                'resource_type' => 'in:' . implode(',', $this->allowed_resources),
                'resource_id' => 'required_with:resource_type|numeric|exists:' . (!empty(Input::get('resource_type')) && !is_null(Input::get('resource_type')) ? (new \ReflectionClass(Input::get('resource_type')))->getMethod('getTableName')->invoke(null) . ',id' : ''),
            ]);

            if($validator->fails()){
                return response()->json(['errors' => $validator->errors(), 'status' => 'failed']);
            }

            $metric = $this->metricService->publishMetric(Input::get('name'), Input::get('value'), Input::get('type'), Input::get('resource_type'), Input::get('resource_id'), Auth::user());

            return response()->json(['status' => 'success', 'metric_id' => $metric->id]);

        }
        abort(400);
    }

}
