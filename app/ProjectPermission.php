<?php

namespace App;

use App\ProjectPermission;
use Illuminate\Database\Eloquent\Model;

class ProjectPermission extends Model
{	
    protected $table = 'projectPermissions';
	
	protected $fillable = [
        'user_id',
		'project_id'
    ];
	
	public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	public function project()
    {
        return $this->belongsTo('App\Project');
    }
	
	public static function checkForPermission($userId, $projectId)
	{
		$exists = ProjectPermission::where('user_id', '=', $userId)->where('project_id', '=', $projectId)->first();
		return $exists !== null;
	}
}
