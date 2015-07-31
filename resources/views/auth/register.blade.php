<!-- resources/views/auth/register.blade.php -->
@extends('layouts.default')
@section('content')
<div class="container">
    <form method="POST" action="/auth/register" class="form-signin">
        {!! csrf_field() !!}

        <h2 class="form-signin-heading">Please register</h2>

        <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control"  placeholder="Name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" id="email" class="form-control"  placeholder="Email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>

        <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" if="password_confirmation" placeholder="Confirm Password" name="password_confirmation" required>
        </div>

        <button class="btn btn-large btn-primary" type="submit">Register</button>
    </form>

    @include('errors.list')
</div>
@stop