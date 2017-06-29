<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Course;
use App\Post;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    use ValidatesRequests;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        $comments = $post->comments();
        return view('layouts.comment', ['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'content' => 'required',
            ]);
            $c = new Comment;
            $c->user_id = $request->user()->id;
            if(isset($request->post_id))
                $c->post_id = $request->post_id;

            if(isset($request->course_id))
                $c->course_id = $request->course_id;

            $c->content = $request->input('content');
            $c->save();

            $return = [];

            if($c->post)
                $resource = $c->post;
            else
                $resource = $c->course;

            $this->metricService->publishCounterWithResource('comment', $resource, Auth::user());

            return response()->view('components.comment', ['resource' => $resource], 200)->header('Content-Type', 'text/html');
        }
        abort(400);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        if ($request->ajax()) {
            if($comment->post)
                $resource = $comment->post;
            else
                $resource = $comment->course;
            $comment->delete();



            return response()->view('components.comment', ['resource' => $resource], 200)->header('Content-Type', 'text/html');
        }
        abort(400);
        //
    }
}
