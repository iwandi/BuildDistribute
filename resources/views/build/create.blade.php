@extends('layouts.default')
@section('content')
    <h1>Add Build for Project {{ $project->name }}</h1>
    <div>
    	{!! Form::open(['url' => action('BuildController@store', $project->name) ]) !!}
    		@include('build.form', ['submitText'=>'Add Build'])    		    	
    	{!! Form::close() !!}

        @include('errors.list')
    </div>
@stop