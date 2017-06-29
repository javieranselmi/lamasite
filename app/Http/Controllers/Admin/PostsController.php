<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PostsController extends AdminController
{
    use ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required|max:2056',
            'photo' => 'required|image',
        ]);


        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            $FileUpload = $request->file('photo');
            $ProductImage = Image::make($FileUpload)->resize(200,200)->stream();
            $photo = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImage->__toString());

            $photo->save();
            $post = new Post([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'description' => $request->input('description')
            ]);
            $post->file()->associate($photo);
            $post->user()->associate($request->user());
            $post->save();
            if(Input::get('new')){
                return redirect()->route('posts.create', ['status' => 'success', 'message' => 'Categoria Creada']);
            }
            //return redirect()->route('posts.index',['status' => 'success', 'message' => 'Post creado!']);
            return redirect()->route('posts.index')->with(['status' => 'success', 'message' => 'Post creado!']);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required|max:2056',
        ]);


        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $FileUpload = $request->file('photo');
            $ProductImage = Image::make($FileUpload)->resize(200,200)->stream();
            $photo = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImage->__toString());
            $post->file->delete();
            $post->file()->associate($photo);
        }
        $post->save();
        return redirect()->route('posts.index')->with(['status' => 'success', 'message' => 'Post editado correctamente!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if ($request->ajax()) {
            $post->delete();
            return response()->json(['status' => 'success', 'message' => "Post  Borrado"]);
        }
        abort(400);
        //
    }
}
