<?php

namespace App\Providers;

use App\Build;
use App\Project;
use Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		// TODO: pass only allowed projects once user admin is setup
		$allowedProjects = Project::all();
		$resourceName = Request::segment(1);
		$resourceInPath = null;
		
		if ($resourceName == 'projects') {
			$resourceInPath = Project::findByIdOrname(str_replace("%20", " ", Request::segment(2)));
		}
		else if ($resourceName == 'builds') {
			$resourceInPath = Build::find(Request::segment(2));
		}
		
        view()->share('commonData', ['allowedProjects' => $allowedProjects, 'resourceInPath' => $resourceInPath]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
