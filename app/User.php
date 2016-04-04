<?php

namespace App;

use App\Ability;
use App\ProjectPermission;
use App\Project;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{	
    protected $table = 'users';
    
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function projectPermissions() {
		return $this->hasMany('App\ProjectPermission');
	}
	
	// TODO use map reduce here too?
	public function projects() {
		$permissions = $this->projectPermissions;
		
		$projects = [];
		
		foreach ($permissions as $permission) {
			$projects[] = $permission->project;
		}
		
		return $projects;
	}
	
	// TODO use map reduce?
	public function projectNames() {
		$projects = $this->projects();
		
		$projectNames = [];
		
		foreach ($projects as $project) {
			$projectNames[] = $project->name;
		}
		
		return $projectNames;
	}
	
	public function role() {
		return $this->belongsTo('App\Role');
	}
	
	public function hasRole($roleName) {
		if (!$roleName) {
			return false;
		}
		
		$input = explode('|', $roleName);

		foreach ($input as $key => $value) {
			
			if ($this->role->name === $value) {
				return true;
			}
		}
		
		return false;
	}
}
