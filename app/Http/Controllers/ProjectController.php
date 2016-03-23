<?php

namespace App\Http\Controllers;

use Gate;
use Validator;
use App\User;
use App\Project;
use App\Build;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class ProjectController extends Controller
{	
	public function index()
    {	
		return view('common.buildsList');
    }

    public function show($id)
    {
		$project = Project::findByIdOrName($id);
		
		if (Gate::denies('viewOneProject', $project->id)) {
			abort(403);
		}
		
		$builds = [];
		
		if ($project)
		{
			$builds = $project->builds()->orderBy('created_at', 'desc')->get();
		}
						
		return view('common.buildsList', compact('builds'));
    }
	
	public function create()
    {		
		return view('common.createProject');
    }
	
	public function edit()
    {		
		return view('common.editProject');
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
	
	public function update(Request $request, $projectId)
    {
		
		$input = $request->all();
			
		$validator = Validator::make($input, [
			'name' => 'required|unique:projects',
		]);
		
		if ($validator->fails()) {
			return redirect()->back()
				->withInput($request->all())
				->withErrors($validator->errors());
		}
		
		$project = Project::findByIdOrName($projectId);
		
		$project->update($request->only('name'));
	
		return redirect()->intended('/');
    }
}
