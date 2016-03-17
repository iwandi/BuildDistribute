<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use App\Project;
use App\Build;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class ProjectController extends Controller
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

    public function show(Request $request, Guard $auth)
    {
		$project = Project::findByIdOrName($request->projectId);
		if ($project)
		{
			$builds = $project->builds()->orderBy('created_at', 'desc')->get();
		}
						
		return view('partials.builds', compact('builds'))->with('projects', Project::all());
    }
	
	public function create()
    {		
		return view('partials.createProject')->with('projects', Project::all());
    }
	
    public function store(Request $request)
    {		
		$input = $request->all();
			
		$validator = Validator::make($input, [
			'name' => 'required|unique:projects',
			'ident' => 'required|unique:projects'
		]);
		
		if ($validator->fails()) {
			return redirect()->back()
				->withInput($request->all())
				->withErrors($validator->errors());
		}
		
		$project = Project::create($request->all());
	
		return redirect()->intended('/');

		
    }
}
