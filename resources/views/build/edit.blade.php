@extends('layouts.default')
@section('content')
    <h1>Edit Build</h1>
    <div>
    	{!! Form::model($build, ['method' => 'PATCH', 'route' => ['project.build.update', $project->name, $build->id ] ]) !!}
    		@include('build.form', ['submitText'=>'Edit Build'])	    	
    	{!! Form::close() !!}

    	{!! Form::open(['route' => ['project.build.destroy', $project->name, $build->id ], 'method' => 'DELETE']) !!}
	        <button type="submit" class="btn btn-danger btn-mini">Delete</button>
	    {!! Form::close() !!}

    	@include('errors.list')
    </div>
@stop