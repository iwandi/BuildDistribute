@extends('layouts.default')
@section('content')
	<div calss="container">
	    <h1>Projects</h1>
		<div calss="container">
			<a href="{{ action('ProjectController@create') }}" class="btn btn-default">Create Project</a>
	    </div>
	    @if (count($projectList))
	    	<ul>
		    @foreach ($projectList as $project)		    
			    <li>
			    	<a href="{{ action('ProjectController@show', [$project->name]) }}">{{ $project->name }}</a>
					<a href="{{ action('ProjectController@edit', [$project->name]) }}" class="btn btn-default">Edit</a>
			    </li>
			@endforeach
			</ul>
		@else
			No Projects
		@endif
	</div>    
@stop