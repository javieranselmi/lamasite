<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class QuestionsController extends AdminController
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
        $Questions = \App\Question::all();

        $ViewParameters = ['questions' => $Questions];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.questions.questions_list', $ViewParameters);
    }

    public function add_form(){
        return view('admin.questions.questions_add');
    }

    public function create_question(Request $request){
        $validator = Validator::make($request->all(), [
            'question_title' => 'required',
            'question_answers' => 'required',
            'correct_answer' => 'required'
        ]);

        if($validator->fails()){
            return view('admin.questions.questions_add', ['failed' => true, 'errors' => $validator->errors()]);
        }

        $QuestionTitle = Input::get('question_title');
        $Question = \App\Question::create(['title' => $QuestionTitle]);

        $QuestionAnswers = Input::get('question_answers');
        $CorrectAnswer = Input::get('correct_answer')[0];

        foreach($QuestionAnswers as $index => $questionAnswer){
            $Answer = \App\Answer::create(['content' => $questionAnswer, 'is_correct' => ($index == $CorrectAnswer), 'question_id' => $Question->id]);
        }

        return redirect()->route('admin_questions', ['status' => 'success', 'message' => 'Pregunta Creada']);
    }



    public function edit_form($question_id){
        $Question = \App\Question::find($question_id);
        if($Question == null)
            abort(404);

        return view('admin.questions.questions_edit', ['question' => $Question]);
    }

    public function edit_question($question_id, Request $request){
        $Question = \App\Question::find($question_id);
        if($Question == null)
            abort(404);


        $validator = Validator::make($request->all(), [
            'question_title' => 'required',
            'question_answers' => 'required',
            'correct_answer' => 'required'
        ]);

        if($validator->fails()){
            return view('admin.questions.questions_edit', ['failed' => true, 'errors' => $validator->errors(), 'question' => $Question]);
        }

        $QuestionTitle = Input::get('question_title');
        $Question->title = $QuestionTitle;

        $QuestionAnswers = Input::get('question_answers');
        $CorrectAnswer = Input::get('correct_answer')[0];
        $AnswersIDs = Input::get('answers_id');

        if(count($AnswersIDs) > 0){
            $AnswersToRemove = $Question->answers->diff(\App\Answer::whereIn('id', $AnswersIDs)->get());
            foreach($AnswersToRemove as $answerToRemove){
                $answerToRemove->delete();
            }
            foreach($AnswersIDs as $index => $answerID){
                Log::info("answerId is " . $answerID);
                $Answer = $Question->answers->where('id', $answerID)->first();
                if(!is_null($Answer)){
                    Log::info("AnswerID: " . $Answer->id . ", content should be: " . $QuestionAnswers[$index] . ", and index is: " . $index . " and CorrectAnswer is " . $CorrectAnswer);
                    $Answer->is_correct = ($index == $CorrectAnswer);
                    $Answer->content = $QuestionAnswers[$index];
                    $Answer->save();
                }
            }
        }

        for($i = count($AnswersIDs); $i < count($QuestionAnswers); $i++){
            \App\Answer::create(['content' => $QuestionAnswers[$i], 'is_correct' => ($i == $CorrectAnswer), 'question_id' => $Question->id]);
        }

        return redirect()->route('admin_questions', ['status' => 'success','message' => 'Pregunta Editada']);
    }

    public function delete_question($question_id, Request $request){
        if($request->ajax()) {
            $Question = \App\Question::find($question_id);
            if ($Question == null)
                return response()->json(['status' => 'error', 'message' => "Pregunta no existente"]);

            $Question->delete();
            return response()->json(['status' => 'success', 'message' => "Pregunta Borrada"]);
        }
        abort(400);
    }
}
