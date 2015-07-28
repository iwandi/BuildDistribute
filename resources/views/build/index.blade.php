@extends('layouts.default')
@section('content')
	<div calss="container">
	    <h1>{{ $project->name }}</h1>

	    <a href="{{ action('ProjectController@edit', [$project->name]) }}" class="btn btn-default">Edit</a>
		<a href="{{ action('BuildController@create', [$project->name]) }}" class="btn btn-default">Add Build</a>

	    @if (count($buildList))
	    	<ul>
		    @foreach ($buildList as $build)	    	    
			    <li>
			    	Platform: {{ $build->platform }}, Build Version: {{ $build->version }}, Revision: {{ $build->revision }}
			    	<a href="{{ route('project.build.show', ['projectId' => $project->name,'buildId' => $build->id]) }}" class="btn btn-default">Detail</a>
			    	@if ($build->platform == 'IPhone')
			            <a href="{{ $build->installUrl }}" class="btn btn-primary">Install // TODO</a>            
			        @else
			            <a href="{{ $build->installUrl }}" class="btn btn-primary">Download</a>
			        @endif
			    </li>
			@endforeach
			</ul>
		@else
			No Builds
		@endif
	</div>    
@stop