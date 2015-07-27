@extends('layouts.default')
@section('content')
    <h1>Edit Project</h1>
    <div>
    	{!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectController@update', $project->id] ]) !!}
    		@include('project.form', ['submitText'=>'Edit Project'])	    	
    	{!! Form::close() !!}


    	@include('errors.list')
    </div>
@stop