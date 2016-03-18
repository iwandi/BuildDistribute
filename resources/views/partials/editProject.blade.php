@extends('layouts.app') @section('mainView')
<?php $projectInPath = $commonData['projectInPath']; ?>
@if (isset($projectInPath))
<div class="container">
	<form class="form-signin" method="POST" action="{{ url('/projects/'.$projectInPath->name.'/edit') }}">
		{!! csrf_field() !!}
		<fieldset class="form-group">

			<label class="sr-only">Project Name</label>
			<input type="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{$projectInPath->name}}">
			 @if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
			@endif
			
			<input class="form-control" type="text" placeholder="Ident: {{$projectInPath->ident}}" disabled>
			<p class="text-muted text-xs-right">*Project ident cannot be modified</p>
			<br>
			<button type="submit" class="btn btn-lg btn-primary btn-block">Save changes</button>
		</fieldset>
	</form>
</div>
@endif
@endsection