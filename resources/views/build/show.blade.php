@extends('layouts.default')
@section('content')
	@if ($project && $build)
    	<h1>{{ $project->name }}</h1>
    	<h2>Platform: {{ $build->platform }}, Build Version: {{ $build->version }}, Revision: {{ $build->revision }}</h2>
    	Install URL: {{ $build->installUrl }}<br>

        @if ($build->platform == 'IPhone')
            <a href="{{ $build->installUrl }}" class="btn btn-primary">Install // TODO</a>            
        @else
            <a href="{{ $build->installUrl }}" class="btn btn-primary">Download</a>
        @endif

        <a href="{{ route('project.build.edit', [$project->name, $build->id]) }}" class="btn btn-default">Edit</a>
    @else
    	Unknown Build
    @endif

@stop