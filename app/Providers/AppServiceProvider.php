<?php

namespace App\Providers;

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
		$allowedProjects = Project::all();
		$projectInPath = Project::findByIdOrname(str_replace("%20", " ", Request::segment(2)));
		
        view()->share('commonData', ['allowedProjects' => $allowedProjects, 'projectInPath' => $projectInPath]);
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
