<?php

namespace App\Http\Controllers;

use App\Project;
use App\Build;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class BuildController extends Controller
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
	
	public function show($buildId)
	{
		$build = Build::find($buildId);
		
		if (!$build) {
			abort(404);
		}
		else {
			return redirect()->intended('/projects/'.$build->project->name.'/builds/'.$buildId);
		}
	}
	
	public function nestedShow($projectId, $buildId)
	{
		$build = Build::find($buildId);
    
		return view('partials.buildDetail', compact('build'));
	}
}
