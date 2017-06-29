<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ShareCourse;
use App\Course;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class CoursesController extends Controller
{
    use ValidatesRequests;
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
    public function index()
    {
        $Courses = \App\Course::withStages()->get();
        return view('courses', ['courses' => $Courses]);
    }

    public function getCourse($course_id)
    {
        $Course = \App\Course::find($course_id);
        if(is_null($Course))
            abort(404);

        return view('course_stages_list', ['course' => $Course]);
    }

    public function share(Request $r)
    {
        if ($r->ajax()) {
            $course = Course::find($r->course_id);
            $this->validate($r,[
                'email' => 'email|required'
            ]);
            $comment = $r->exists('comentario') ? $r->comentario : '';

            Mail::to($r->email)->send(new ShareCourse($course, $comment));
            $course->share_count = $course->share_count + 1;
            $course->save();
            $this->metricService->publishCounterWithResource('share', $course, Auth::user());
            return response()->json(['status' => 'success',
                'message' => 'Email enviado!',
                'share_count' => $course->share_count,
                'course_id' => $course->id
            ]);
        }
        abort(400);
    }
}
