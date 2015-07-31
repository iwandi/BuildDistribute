<!-- resources/views/auth/login.blade.php -->
@extends('layouts.default')
@section('content')
<div class="container">
    <form method="POST" action="/auth/login" class="form-signin">
        {!! csrf_field() !!}

        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" value="{{ old('email') }}"  required autofocus>

        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
            <input type="checkbox" name="remember"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
    </form>
</div>

    @include('errors.list')
@stop