@extends('layouts.default')
@section('content')
    <h2>Edit Project</h2>
    <div class="container">      
    	{!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectController@update', $project->id] ]) !!}
    		@include('project.form', ['submitText'=>'Edit Project'])	    	
    	{!! Form::close() !!}

    	{!! Form::open(['action' => ['ProjectController@destroy', $project->id], 'method' => 'DELETE']) !!}
	        <button type="submit" class="btn btn-danger">Delete</button>
	    {!! Form::close() !!}

    	@include('errors.list')
    </div>
@stop