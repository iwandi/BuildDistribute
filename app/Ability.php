<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $table = 'abilities';
	
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
