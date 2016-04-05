<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
		'ident'
    ];

    public static function findByIdOrName($idOrName)
    {
        $project = Project::find($idOrName);
        if (!$project)
        {
            $projectList = Project::where('name', $idOrName);
            if ($projectList->count())
            {
                $project = $projectList->first();
            }
        }

        return $project;
    }
	
    public function builds()
    {
        return $this->hasMany('App\Build');
    }
	
	public function projectPermissions() {
		return $this->hasMany('App\ProjectPermission');
	}
	
	public function users() {
		$permissions = $this->projectPermissions;
		
		$users = [];
		
		foreach ($permissions as $permission) {
			$users[] = $permission->user;
		}
		
		return $users;
	}
}
