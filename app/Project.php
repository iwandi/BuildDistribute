<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table = 'project';

    protected $fillable = [
    	'name'
    ];

    public static function getByIdOrName($id)
    {
    	$project = Project::find($id);
        if (!$project)
        {                
            $projectList = Project::where('name',$id);
            if ($projectList->count())
            {
                $project = $projectList->first();
            }
        }

        return $project;
    }

    public function build()
    {
        return $this->hasMany('App\Build');
    }
}
