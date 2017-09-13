<?php

namespace App\Http\Controllers;

class PingController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response('PONG', 200);
    }
}
