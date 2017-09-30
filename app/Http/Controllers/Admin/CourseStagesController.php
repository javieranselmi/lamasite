<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseStagesController extends AdminController
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
        $CourseStages = \App\CourseStage::all();

        $ViewParameters = ['course_stages' => $CourseStages];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.course_stages.course_stages_list', $ViewParameters);
    }

    public function add_form(){
        $Courses = \App\Course::all();
        $Questions = \App\Question::notRelated()->get();

        $ViewParameters = ['courses' => $Courses, 'questions' => $Questions];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        if(Input::get('iframe')){
            $ViewParameters['iframe'] = true;
        }

        if(Input::get('course_id')){
            $ViewParameters['course_id'] = Input::get('course_id');
        }

<<<<<<< HEAD


=======
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        return view('admin.course_stages.course_stages_add', $ViewParameters);
    }

    public function create_course_stage(Request $request){
<<<<<<< HEAD
=======

>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        $validator = Validator::make($request->all(), [
            'course_stage_name' => 'required',
            'course_stage_description' => 'required',
            'course_stage_type' => 'required|in:html,ppt,vid_ppt,questionnaire',
            'course_stage_duration_in_minutes' => 'required|integer',
<<<<<<< HEAD
            'course_stage_video' => 'required_if:course_stage_type,vid_ppt|mimes:mp4,mpeg,mpg,avi',
            'course_stage_ppt' => 'required_if:course_stage_type,ppt|mimes:ppt,pdf',
            'course_stage_html' => 'required_if:course_stage_type,html|string',
            //'course_stage_course_id' => 'required|exists:courses,id',
            'course_stage_video_position.*' => 'required_if:course_stage_type,vid_ppt|numeric',
            'course_stage_slides.*' => 'required_if:course_stage_type,vid_ppt|mimes:jpg,jpeg,png',
=======
            'course_stage_video' => 'required_if:course_stage_type,vid_ppt',
            'course_stage_ppt' => 'required_if:course_stage_type,ppt',
            'course_stage_html' => 'required_if:course_stage_type,html|string',
            //'course_stage_course_id' => 'required|exists:courses,id',
            'course_stage_video_position.*' => 'required_if:course_stage_type,vid_ppt|numeric',
            'course_stage_slides.*' => 'required_if:course_stage_type,vid_ppt',
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            'course_stage_questions.*' => 'required_if:course_stage_type,questionnaire|exists:questions,id'
        ]);

        $JSON = Input::get('json');

        if($validator->fails()){
            if($JSON){
                return response()->json(['status' => 'failed', 'errors' => $validator->errors()]);
            }
            return view('admin.course_stages.course_stages_add', ['failed' => true, 'errors' => $validator->errors()]);
        }

        $CourseStageType = Input::get('course_stage_type');
        $CourseStageModelParams = ['name' => Input::get('course_stage_name'), 'description' => Input::get('course_stage_description'), 'type' => Input::get('course_stage_type'), 'duration_in_minutes' => Input::get('course_stage_duration_in_minutes')];

        $CourseStageCourseID = Input::get('course_stage_course_id');
        if($CourseStageCourseID && Course::find($CourseStageCourseID)){
            $CourseStageModelParams['course_id'] = $CourseStageCourseID;
        }


        if(in_array($CourseStageType, ["vid_ppt"])){

<<<<<<< HEAD
            $FileUploadVideo = $request->file('course_stage_video');
            Storage::disk(env("APP_STORAGE"))->put($FileUploadVideo->getFilename().'.'.$FileUploadVideo->getClientOriginalExtension(),  File::get($FileUploadVideo));
            $FileVideo = \App\File::create(['file_name_original' => $FileUploadVideo->getClientOriginalName(), 'file_name' => $FileUploadVideo->getFilename().'.'.$FileUploadVideo->getClientOriginalExtension(), 'mime' => $FileUploadVideo->getMimeType()]);
            $CourseStageModelParams['video_id'] = $FileVideo->id;

            $SlideFilesUpload = Input::file('course_stage_slides.*');
            $VideoPositions = Input::get('course_stage_video_position.*');
            $JSON = [];

            foreach ($SlideFilesUpload as $index => $Slide){
                Storage::disk(env("APP_STORAGE"))->put($Slide->getFilename().'.'.$Slide->getClientOriginalExtension(),  File::get($Slide));
                $SlideFiles = \App\File::create(['file_name_original' => $Slide->getClientOriginalName(), 'file_name' => $Slide->getFilename().'.'.$Slide->getClientOriginalExtension(), 'mime' => $Slide->getMimeType()]);
                $JSON[] = ['index' => $index, 'slide' => Storage::url($SlideFiles->file_name), 'video_position' => $VideoPositions[$index]];
=======
            $videoUrl = Input::get('course_stage_video');
            $CourseStageModelParams['video_id'] = null;
            $CourseStageModelParams['video_url'] = $videoUrl;

            $SlideUrls = Input::get('course_stage_slides.*');
            $VideoPositions = Input::get('course_stage_video_position.*');
            $JSON = [];

            foreach ($SlideUrls as $index => $Slide){
                $JSON[] = ['index' => $index, 'slide' => $Slide, 'video_position' => $VideoPositions[$index]];
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            }


            $CourseStageModelParams['json_vid_ppt'] = json_encode($JSON);

        }

        if(in_array($CourseStageType, ["ppt"])){
<<<<<<< HEAD
            $FileUploadPPT = $request->file('course_stage_ppt');
            Storage::disk(env("APP_STORAGE"))->put($FileUploadPPT->getFilename().'.'.$FileUploadPPT->getClientOriginalExtension(),  File::get($FileUploadPPT));
            $FilePPT = \App\File::create(['file_name_original' => $FileUploadPPT->getClientOriginalName(), 'file_name' => $FileUploadPPT->getFilename().'.'.$FileUploadPPT->getClientOriginalExtension(), 'mime' => $FileUploadPPT->getMimeType()]);
            $CourseStageModelParams['ppt_id'] = $FilePPT->id;
=======
            $pptUrl = Input::get('course_stage_ppt');
            $CourseStageModelParams['ppt_id'] = null;
            $CourseStageModelParams['ppt_url'] = $pptUrl;
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        }

        if($CourseStageType == 'html')
            $CourseStageModelParams['html'] = Input::get('course_stage_html');

        $CourseStage = \App\CourseStage::create($CourseStageModelParams);

        if(in_array($CourseStageType, ["questionnaire"])){
            $Questions = Input::get('course_stage_questions');
            foreach($Questions as $questionId){
                $Question = \App\Question::find($questionId);
                if(!is_null($Question)){
                    $Question->course_stage()->associate($CourseStage);
                    $Question->save();
                }
            }
        }

<<<<<<< HEAD
        if($JSON){
            return response()->json(['status' => 'success', 'message' => 'Etapa de Curso Creada', 'course_stage' => $CourseStage]);
=======
        if($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => "Etapa de curso creada", 'course_stage' => $CourseStage]);
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        }

        if(Input::get('new')){
            return redirect()->route('admin_course_stages_add', ['status' => 'success', 'message' => 'Etapa de Curso Creada']);
        }
        return redirect()->route('admin_course_stages', ['status' => 'success', 'message' => 'Etapa de Curso Creada']);
    }



    public function edit_form($course_stage_id){
        $CourseStage = \App\CourseStage::find($course_stage_id);
        if($CourseStage == null)
            abort(404);

        $Courses = \App\Course::all();
        $Questions = \App\Question::notRelated()->get();

        $ViewParameters = ['course_stage' => $CourseStage, 'courses' => $Courses, 'questions' => $Questions];

        if(Input::get('iframe')){
            $ViewParameters['iframe'] = true;
        }

        return view('admin.course_stages.course_stages_edit', $ViewParameters);
    }

    public function edit_course_stage($course_stage_id, Request $request){
        $CourseStage = \App\CourseStage::find($course_stage_id);
        if($CourseStage == null)
            abort(404);


        $validator = Validator::make($request->all(), [
            'course_stage_name' => 'required',
            'course_stage_description' => 'required',
            'course_stage_type' => 'required|in:html,ppt,vid_ppt,questionnaire',
            'course_stage_duration_in_minutes' => 'required|integer',
<<<<<<< HEAD
            'course_stage_video' => 'sometimes|required_if:course_stage_type,vid_ppt|mimes:mp4,mpeg,mpg,avi',
            'course_stage_ppt' => 'sometimes|required_if:course_stage_type,ppt|mimes:ppt,pdf',
            'course_stage_html' => 'required_if:course_stage_type,html|string',
            //'course_stage_course_id' => 'required|exists:courses,id',
            'course_stage_video_position.*' => 'required_if:course_stage_type,vid_ppt|numeric',
            'course_stage_slides.*' => 'sometimes|required_if:course_stage_type,vid_ppt|mimes:jpg,jpeg,png',
=======
            'course_stage_video' => 'sometimes|required_if:course_stage_type,vid_ppt',
            'course_stage_ppt' => 'sometimes|required_if:course_stage_type,ppt',
            'course_stage_html' => 'required_if:course_stage_type,html|string',
            //'course_stage_course_id' => 'required|exists:courses,id',
            'course_stage_video_position.*' => 'required_if:course_stage_type,vid_ppt|numeric',
            'course_stage_slides.*' => 'sometimes|required_if:course_stage_type,vid_ppt',
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            'course_stage_questions.*' => 'required_if:course_stage_type,questionnaire|exists:questions,id'
        ]);

        $JSON = Input::get('json');

        if($validator->fails()){
            if($JSON){
                return response()->json(['status' => 'failed', 'errors' => $validator->errors()]);
            }
            return view('admin.course_stages.course_stages_add', ['failed' => true, 'errors' => $validator->errors()]);
        }

        $CourseStageType = Input::get('course_stage_type');
        $CourseStageModelParams = ['name' => Input::get('course_stage_name'), 'description' => Input::get('course_stage_description'), 'type' => Input::get('course_stage_type'), 'duration_in_minutes' => Input::get('course_stage_duration_in_minutes')];

        $CourseStageCourseID = Input::get('course_stage_course_id');
        if($CourseStageCourseID && Course::find($CourseStageCourseID)){
            $CourseStageModelParams['course_id'] = $CourseStageCourseID;
        }

        if(in_array($CourseStageType, ["vid_ppt"])){

<<<<<<< HEAD
            $FileUploadVideo = $request->file('course_stage_video');
            if($FileUploadVideo != null){
                $FileVideo = \App\File::create(['file_name_original' => $FileUploadVideo->getClientOriginalName(), 'file_name' => $FileUploadVideo->getFilename().'.'.$FileUploadVideo->getClientOriginalExtension(), 'mime' => $FileUploadVideo->getMimeType()], File::get($FileUploadVideo));
                if(!is_null($CourseStage->video))
                    $CourseStage->video->delete();
                $CourseStageModelParams['video_id'] = $FileVideo->id;
=======
            $videoUrl = Input::get('course_stage_video');
            if($videoUrl != null){
                $CourseStageModelParams['video_id'] = null;
                $CourseStageModelParams['video_url'] = $videoUrl;
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            }

            $VideoPositions = Input::get('course_stage_video_position.*');
            $JSON = [];

            if(!is_null($CourseStage->json_vid_ppt)){
                $JSON = json_decode($CourseStage->json_vid_ppt);

                foreach ($VideoPositions as $index => $VideoPosition){
<<<<<<< HEAD
                    $Slide = Input::file('course_stage_slides_'.$index);
                    if($Slide != null){
                        $SlideFiles = \App\File::create(['file_name_original' => $Slide->getClientOriginalName(), 'file_name' => $Slide->getFilename().'.'.$Slide->getClientOriginalExtension(), 'mime' => $Slide->getMimeType()], File::get($Slide));
                        $JSON[$index]->slide = Storage::url($SlideFiles->file_name);
=======
                    $Slide = Input::get('course_stage_slides_'.$index);
                    if($Slide != null){
                        $JSON[$index]->slide =$Slide;
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
                    }
                    $JSON[$index]->video_position = $VideoPosition;
                }
            }

            $CourseStageModelParams['json_vid_ppt'] = json_encode($JSON);

        }

        if(in_array($CourseStageType, ["ppt"])){
<<<<<<< HEAD
            $FileUploadPPT = $request->file('course_stage_ppt');
            if($FileUploadPPT != null){
                $FilePPT = \App\File::create(['file_name_original' => $FileUploadPPT->getClientOriginalName(), 'file_name' => $FileUploadPPT->getFilename().'.'.$FileUploadPPT->getClientOriginalExtension(), 'mime' => $FileUploadPPT->getMimeType()], File::get($FileUploadPPT));
                if(!is_null($CourseStage->ppt))
                    $CourseStage->ppt->delete();
                $CourseStageModelParams['ppt_id'] = $FilePPT->id;
=======
            $pptUrl = Input::get('course_stage_ppt');
            if($pptUrl != null){
                $CourseStageModelParams['ppt_url'] = $pptUrl;
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            }

        }

        if($CourseStageType == 'html')
            $CourseStageModelParams['html'] = Input::get('course_stage_html');

        if(in_array($CourseStageType, ["questionnaire"])){
            foreach($CourseStage->questions as $question){
                $question->course_stage()->dissociate();
                $question->save();
            }

            $Questions = Input::get('course_stage_questions');
            foreach($Questions as $questionId){
                $Question = \App\Question::find($questionId);
                if(!is_null($Question)){
                    $Question->course_stage()->associate($CourseStage);
                    $Question->save();
                }
            }
        }

        $CourseStage->update($CourseStageModelParams);

<<<<<<< HEAD
        if($JSON){
            return response()->json(['status' => 'success', 'message' => 'Etapa de Curso editada', 'course_stage' => $CourseStage]);
        }
=======

        if($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => "Etapa de curso editada", 'course_stage' => $CourseStage]);
        }

>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        return redirect()->route('admin_course_stages', ['status' => 'success', 'message' => 'Etapa de Curso Editada']);
    }

    public function delete_course_stage($course_stage_id, Request $request){
        if($request->ajax()) {
            $CourseStage = \App\CourseStage::find($course_stage_id);
            if ($CourseStage == null)
                return response()->json(['status' => 'error', 'message' => "Etapa de Curso no existente"]);

            $CourseStage->delete();
            return response()->json(['status' => 'success', 'message' => "Etapa de Curso Borrada"]);
        }
        abort(400);
    }
}
