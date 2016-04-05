@extends('layouts.app')

@section('content')
<div class="container">
	<form class="form-signin" method="POST" action="{{ url('/password/reset') }}">
		{!! csrf_field() !!}
		<fieldset class="form-group">
			
			<input type="hidden" name="token" value="{{ $token }}">

			<label class="sr-only">E-Mail Address</label>

			<input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email address" required autofocus> @if ($errors->has('email'))
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

			<button type="submit" class="btn btn-lg btn-primary btn-block">Reset Password</button>
		</fieldset>
	</form>
</div>
@endsection
