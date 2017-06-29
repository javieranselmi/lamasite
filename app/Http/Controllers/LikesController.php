<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Product;
use App\Course;
use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $l = new Like;
            $l->user_id = $request->user()->id;
            if ($request->has('post_id')) {
                if (Like::where([
                    ['user_id', '=', $request->user()->id],
                    ['post_id', '=', $request->post_id]
                ])->exists()) {
                    Like::where([
                        ['user_id', '=', $request->user()->id],
                        ['post_id', '=', $request->post_id]
                    ])->delete();
                    return response()->json(['status' => 'borrado',
                        'count' => Post::find($request->post_id)->likes->count(),
                        'post_id' => $request->post_id ]);
                }
                $l->post_id = $request->post_id;
                $l->save();
                $this->metricService->publishCounterWithResource('like', $l->post, Auth::user());
                return response()->json(['status' => 'success',
                    'count' => Post::find($request->post_id)->likes->count(),
                    'post_id' => $request->post_id
                ]);
            }

            if ($request->has('product_id')) {
                if (Like::where([
                    ['user_id', '=', $request->user()->id],
                    ['product_id', '=', $request->product_id]
                ])->exists()) {
                    Like::where([
                        ['user_id', '=', $request->user()->id],
                        ['product_id', '=', $request->product_id]
                    ])->delete();
                    return response()->json(['status' => 'borrado',
                        'count' => Product::find($request->product_id)->likes->count(),
                        'product_id' => $request->product_id ]);
                }
                $l->product_id = $request->product_id;
                $l->save();
                $this->metricService->publishCounterWithResource('like', $l->product, Auth::user());
                return response()->json(['status' => 'success',
                    'count' => Product::find($request->product_id)->likes->count(),
                    'product_id' => $request->product_id
                ]);
            }

            if ($request->has('course_id')) {
                if (Like::where([
                    ['user_id', '=', $request->user()->id],
                    ['course_id', '=', $request->course_id]
                ])->exists()) {
                    Like::where([
                        ['user_id', '=', $request->user()->id],
                        ['course_id', '=', $request->course_id]
                    ])->delete();
                    return response()->json(['status' => 'borrado',
                        'count' => Course::find($request->course_id)->likes->count(),
                        'course_id' => $request->course_id ]);
                }
                $l->course_id = $request->course_id;
                $l->save();
                $this->metricService->publishCounterWithResource('like', $l->course, Auth::user());
                return response()->json(['status' => 'success',
                    'count' => Course::find($request->course_id)->likes->count(),
                    'course_id' => $request->course_id
                ]);
            }

            if ($request->has('folder_id')) {
                if (Like::where([
                    ['user_id', '=', $request->user()->id],
                    ['folder_id', '=', $request->folder_id]
                ])->exists()) {
                    Like::where([
                        ['user_id', '=', $request->user()->id],
                        ['folder_id', '=', $request->folder_id]
                    ])->delete();
                    return response()->json(['status' => 'borrado',
                        'count' => Folder::find($request->folder_id)->likes->count(),
                        'folder_id' => $request->folder_id ]);
                }
                $l->folder_id = $request->folder_id;
                $l->save();
                $this->metricService->publishCounterWithResource('like', $l->folder, Auth::user());
                return response()->json(['status' => 'success',
                    'count' => Folder::find($request->folder_id)->likes->count(),
                    'folder_id' => $request->folder_id
                ]);
            }


        }
        abort(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Like $like)
    {
        if ($request->ajax()) {
            $like->delete();
            return response()->json(['status' => 'success', 'message' => "Usuario Borrado"]);
        }
        abort(400);
        //
    }
}
