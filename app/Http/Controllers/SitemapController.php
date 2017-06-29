<?php

namespace App\Http\Controllers;

class SitemapController extends Controller
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
        $ProductCategories = \App\ProductCategory::all();
        $Courses = \App\Course::all();
        $Posts = \App\Post::all();

        return view('site_map', ['product_categories' => $ProductCategories, 'courses' => $Courses, 'posts' => $Posts]);
    }
}
