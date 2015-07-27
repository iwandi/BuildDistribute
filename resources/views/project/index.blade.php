@extends('layouts.default')
@section('content')
    <div>Index</div>
    @if (count($projectList))
    	<ul>
	    @foreach ($projectList as $project)
		    <li><a href="{{ action('ProjectController@show', [$project->name]) }}">{{ $project->name }}</a></li>
		@endforeach
		</ul>
	@else
		No Projects
	@endif
    <div>
    	<a href="{{ action('ProjectController@create') }}">Add Project</a>
    </div>
@stop