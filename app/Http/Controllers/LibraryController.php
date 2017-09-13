<?php

namespace App\Http\Controllers;

use App\Mail\SharePost;
use App\Post;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LibraryController extends Controller
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
        $Posts = Post::all();
        return view('library_post_list', ['posts' => $Posts]);
    }

    public function getPost($post_id)
    {
        $Post = Post::find($post_id);
        if(is_null($Post))
            abort(404);

        $this->metricService->publishResourceVisit($Post, Auth::user());
        return view('library_post_detail', ['post' => $Post]);
    }

    public function share(Request $r)
    {
        if ($r->ajax()) {
            $post = Post::find($r->post_id);
            $this->validate($r,[
                'email' => 'email|required'
            ]);
            Mail::to($r->email)->send(new SharePost($post));
            $post->share_count = $post->share_count + 1;
            $post->save();
            $this->metricService->publishCounterWithResource('share', $post, Auth::user());
            return response()->json(['status' => 'success', 'message' => 'Email enviado!', 'share_count' => $post->share_count]);
        }
        abort(400);
    }
}
