@extends('layouts.default')
@section('content')
    <h1>Create Project</h1>
    <div>
    	{!! Form::open(['url' => action('ProjectController@store') ]) !!}
    		@include('project.form', ['submitText'=>'Create Project'])    		    	
    	{!! Form::close() !!}

        @include('errors.list')
    </div>
@stop