@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
	<form class="form-signin" method="POST" action="{{ url('/password/email') }}"">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		{!! csrf_field() !!}
		<fieldset class="form-group">

			<label class="sr-only">E-Mail Address</label>

			<input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email address" required autofocus>
			@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif

			<button type="submit" class="btn btn-lg btn-primary btn-block">Send Password Reset Link</button>
		</fieldset>
	</form>
</div>
@endsection
