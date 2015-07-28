<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    //
    protected $table = 'build';

    protected $fillable = [
    	'installUrl',
    	'version',
    	'platform',
    	'revision',
    	'androidBundleVersionCode',
    	'iPhoneBundleIdentifier',
    	'iPhoneBundleVersion',
    	'iPhoneTitle',
    ];

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function scopeIdent($query, $projectId, $search)
    {
        return $query->where('project_id', $projectId)
            ->where(function($query) use ($search)
            {
                $query->where('platform', $search)
                    ->orWhere('version', $search)
                    ->orWhere('revision', $search);
            });
    }
}
