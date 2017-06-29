<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Input::get('q');
        $this->metricService->publishCounterWithValue('search', $query, Auth::user());
        if(!empty($query)){
            $ProductResults = \App\Product::where('name', 'like', '%'.$query.'%')->get();
            $CourseResults = \App\Course::where('name', 'like', '%'.$query.'%')->get();
            $PostResults = \App\Post::where('title', 'like', '%'.$query.'%')->get();

            return view('search', ['product_results' => $ProductResults, 'course_results' => $CourseResults, 'post_results' => $PostResults]);

        }
        return redirect()->route("home");
    }
}
