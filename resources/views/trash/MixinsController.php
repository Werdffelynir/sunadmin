<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MixinsController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('mixins');
    }

    public function list()
    {
        return view('mixins');
    }

    public function create()
    {
        return view('mixins');
    }
}
