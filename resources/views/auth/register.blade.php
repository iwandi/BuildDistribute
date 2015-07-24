<!-- resources/views/auth/register.blade.php -->
@extends('layouts.default')
@section('css')
    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin .checkbox {
      font-weight: normal;
    }
    .form-signin .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
@stop
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
</div>
@stop