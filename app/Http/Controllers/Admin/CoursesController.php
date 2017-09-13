<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CoursesController extends AdminController
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
        $Courses = \App\Course::all();

        $ViewParameters = ['courses' => $Courses];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.courses.courses_list', $ViewParameters);
    }

    public function add_form(){

        $ViewParameters = [];
        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.courses.courses_add', $ViewParameters);
    }

    public function create_course(Request $request){
        $validator = Validator::make($request->all(), [
            'course_name' => 'required',
            'course_description' => 'required',
            'course_featured' => 'boolean',
            'course_photo' => 'required|image',
            'course_finish_date' => 'required|date'
        ]);

        if($validator->fails()){
            return view('admin.courses.courses_add', ['failed' => true, 'errors' => $validator->errors()]);
        }

        $CourseName = Input::get('course_name');
        $CourseDescription = Input::get('course_description');
        $FileUpload = $request->file('course_photo');

        $File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], File::get($FileUpload));
        $Course = \App\Course::create(['name' => $CourseName, 'description' => $CourseDescription, 'file_id' => $File->id, 'finish_date' => Input::get('finish_date')]);

        $CourseStages = Input::get('course_stages_ids');

        if(is_array($CourseStages)){
            foreach($CourseStages as $courseStageID){
                $CourseStage = \App\CourseStage::find($courseStageID);
                $CourseStage->course()->associate($Course);
                $CourseStage->save();
            }
        }

        if(Input::get('new')){
            return redirect()->route('admin_courses_add', ['status' => 'success', 'message' => 'Curso Creado']);
        }
        return redirect()->route('admin_courses', ['status' => 'success', 'message' => 'Curso Creado']);
    }



    public function edit_form($course_id){
        $Course = \App\Course::find($course_id);
        if($Course == null)
            abort(404);

        return view('admin.courses.courses_edit', ['course' => $Course]);
    }

    public function edit_course($course_id, Request $request){
        $Course = \App\Course::find($course_id);
        if($Course == null)
            abort(404);


        $validator = Validator::make($request->all(), [
            'course_name' => 'required',
            'course_description' => 'required',
            'course_featured' => 'boolean',
            'course_photo' => 'sometimes|required|image',
            'course_finish_date' => 'required|date'
        ]);

        if($validator->fails()){
            return view('admin.courses.courses_edit', ['failed' => true, 'errors' => $validator->errors(), 'course' => $Course]);
        }

        $CourseName = Input::get('course_name');
        $CourseDescription = Input::get('course_description');
        $FinishDate = Input::get('course_finish_date');
        $FileUpload = $request->file('course_photo');

        if($FileUpload != null){
            $File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], File::get($FileUpload));
            $Course->file->delete();
            $Course->file()->associate($File);

        }

        $Course->name = $CourseName;
        $Course->description = $CourseDescription;
        $Course->finish_date = $FinishDate;
        $Course->save();

        return redirect()->route('admin_courses', ['status' => 'success','message' => 'Curso Editado']);
    }

    public function delete_course($course_id, Request $request){
        if($request->ajax()) {
            $Course = \App\Course::find($course_id);
            if ($Course == null)
                return response()->json(['status' => 'error', 'message' => "Curso no existente"]);

            $Course->delete();
            return response()->json(['status' => 'success', 'message' => "Curso Borrado"]);
        }
        abort(400);
    }
}
