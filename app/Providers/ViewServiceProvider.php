<?php

namespace App\Providers;

use Request;
use Auth;
use App\User;
use App\Project;
use App\ProjectPermission;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		view()->composer('common.*', function ($view) {
			$sessionUser = Auth::user();
						
			if ($sessionUser->isSuperAdmin() || $sessionUser->role->name === 'wlpTeam') {
				$allowedProjects = Project::all();
			}
			else {
				$allowedProjects = $sessionUser->projects();
			}
			
			$resourceName = Request::segment(1);
			$resourceInPath = null;
			
			if ($resourceName == 'projects') {
				$resourceInPath = Project::findByIdOrname(str_replace("%20", " ", Request::segment(2)));
			}
			else if ($resourceName == 'builds') {
				$resourceInPath = Build::find(Request::segment(2));
			}
			
			view()->share('commonData', ['allowedProjects' => $allowedProjects, 'resourceInPath' => $resourceInPath]);
		});
	}

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
