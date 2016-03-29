<?php

namespace App\Providers;

use Gate;
use Request;
use Auth;
use App\User;
use App\Project;
use App\ProjectPermission;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
	public static function getResourceInPath()
	{
		$resourceName = Request::segment(1);
		$resourceInPath = null;
		
		if ($resourceName == 'projects') {
			$resourceInPath = Project::findByIdOrname(str_replace("%20", " ", Request::segment(2)));
		}
		else if ($resourceName == 'builds') {
			$resourceInPath = Build::find(Request::segment(2));
		}
		
		return $resourceInPath;
	}
	
	public static function getAllowedProjects()
	{
		$user = Auth::user();
		
		$allowedProjects = [];
		
		if (Gate::allows('viewAllProjects')) {
			$allowedProjects = Project::all();
		}
		else {
			$allowedProjects = $user->projects();
		}
		
		return $allowedProjects;
	}

    public function register()
    {
        //
    }
}
