<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseStagesController extends Controller
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

    public function getCourseStage($course_id, $course_stage_id)
    {
        $CourseStage = \App\CourseStage::find($course_stage_id);
        if(is_null($CourseStage))
            abort(404);

        if(!Auth::user()->didCompleteStage($course_stage_id)){
            Auth::user()->courseStages()->attach($CourseStage);
        }

        return view('course_stage', ['course_stage' => $CourseStage]);
    }
}
