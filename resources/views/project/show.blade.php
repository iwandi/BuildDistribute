@extends('layouts.default')
@section('content')
	@if ($project)
    	<h1>{{ $project->name }}</h1>

    	{!! Form::open(['action' => ['ProjectController@edit', $project->name], 'method' => 'GET']) !!}
	        <button type="submit" class="btn btn-mini">Edit</button>
	    {!! Form::close() !!}
    @else
    	Unknown project
    @endif

@stop