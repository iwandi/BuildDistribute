<?php

namespace App\Providers;

use Auth;
use App\ProjectPermission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
		
		$gate->before(function($user, $ability) {
			if ($user->hasRole('superAdmin')) {
				return true;
			}
		});
		
		$gate->define('manageAll', function($user) {
			return $user->hasRole('superAdmin');
		});
		
		$gate->define('viewOneProject', function($user, $projectId) {
			if ($user->hasRole('wlpTeam')) {
				return true;
			}
			return ProjectPermission::checkForPermission($user->id, $projectId);
		});
		
		$gate->define('viewOneProject', function($user, $projectId) {
			if ($user->can('viewAllProjects')) {
				return true;
			};
			return ProjectPermission::checkForPermission($user->id, $projectId);
		});
		
		$gate->define('modifyProjects', function($user) {
			return $user->hasRole('superAdmin');
		});
    }
}
