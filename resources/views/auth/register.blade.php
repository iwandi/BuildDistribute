@extends('layouts.app') @section('content')
<div class="container">
	<form class="form-signin soft-shadow" method="POST" action="{{ url('/register') }}">
		{!! csrf_field() !!}
		<fieldset class="form-group">

			<label class="sr-only">Name</label>

			<input type="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your name"> @if ($errors->has('name'))
			<span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif

			<label class="sr-only">E-Mail Address</label>

			<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus> @if ($errors->has('email'))
			<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span> @endif

			<label class="sr-only">Password</label>

			<input type="password" class="form-control" name="password" placeholder="Password" required> @if ($errors->has('password'))
			<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span> @endif

			<label class="sr-only">Confirm Password</label>


			<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required> @if ($errors->has('password_confirmation'))
			<span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span> @endif

			<button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
		</fieldset>
	</form>
	<p class="text-xs-center">
		<a class="text-muted" href="{{ url('/login') }}">Already have an account? Login here</a>
	</p>
</div>
@endsection