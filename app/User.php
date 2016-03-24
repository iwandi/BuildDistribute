<?php

namespace App;

use App\Ability;
use App\ProjectPermission;
use App\Project;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{	
    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function projectPermissions() {
		return $this->hasMany('App\ProjectPermission');
	}
	
	public function projects() {
		$permissions = $this->projectPermissions;
		
		$projects = [];
		
		foreach ($permissions as $permission) {
			$projects[] = $permission->project;
		}
		
		return $projects;
	}
	
	public function projectNames() {
		$projects = $this->projects();
		
		$projectNames = [];
		
		foreach ($projects as $project) {
			$projectNames[] = $project->name;
		}
		
		return $projectNames;
	}
	
	public function abilities() {
		return $this->hasMany('App\Ability');
	}
	
	public function can($abilityName) {
		$ability = Ability::where('name', '=', $abilityName)->first();
		
		$exists = Ability::where('user_id', '=', $userId)->where('ability_id', '=', $ability->id)->first();
		
		return $exists !== null;
	}
}
