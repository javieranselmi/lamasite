<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        $FeaturedProduct = \App\Product::featured()->get();
        $FeaturedCourse = \App\Course::orderBy('created_at', 'desc')->get()->first();
        $News = \App\News::first();

        return view('home', ['featured_product' => $FeaturedProduct, 'featured_course' => $FeaturedCourse, 'news' => $News]);
    }
}
