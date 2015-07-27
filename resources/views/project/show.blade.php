@extends('layouts.default')
@section('content')
	@if ($project)
    	<h1>{{ $project->name }}</h1>
    	<a href="{{ action('ProjectController@edit', [$project->name]) }}">Edit</a>
    	<a href="{{ action('ProjectController@destroy', [$project->id]) }}">Delete</a>
    @else
    	Unknown project
    @endif

@stop