<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\User;
use App\Project;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class AdminController extends Controller
{
    public static function getUsers()
    {
		if (Gate::denies('manageUsers')) {
			abort(403);
		}
		
		$users = User::all();
		
        return view('admin.usersList', compact('users'));
    }
	
	public static function getProjects()
    {
		if (Gate::denies('manageProjects')) {
			abort(403);
		}
		
		$projects = Project::all();
				
        return view('admin.projectsList', compact('projects'));
    }
}
