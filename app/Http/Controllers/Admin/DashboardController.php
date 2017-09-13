<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends AdminController
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
        $Users = \App\User::all();
        $LoginMetrics = \App\Metric::counterByName('login');
        $MostSearchedQueries = \App\Metric::counterByName('search', 'value');
        $Products = \App\Product::all();
        $Posts = \App\Post::all();
        $Files = \App\File::all()->filter(function($item, $key){
           return $item->downloads > 0;
        });
        $Comments = \App\Comment::all();
        $Courses = \App\Course::all();
        return view('admin.dashboard', ['users' => $Users, 'user_login_metrics' => $LoginMetrics, 'most_searched' => $MostSearchedQueries, 'products' => $Products, 'posts' => $Posts, 'files' => $Files, 'comments' => $Comments, 'courses' => $Courses]);
    }
}
