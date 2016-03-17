<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class HomeController extends Controller
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
    public static function index(Guard $auth)
    {
		$projects = Project::all();
        return view('index', compact('projects'));
    }
}
