<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>Build Distribution</title>

	<!-- Fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{url('css/styles.css')}}">

	<!-- CSS Addons -->
	<link rel="stylesheet" href="{{url('css/pushy.css')}}">
	<link rel="stylesheet" href="{{url('css/normalize.css')}}">

</head>

<body id="app-layout">

	<!-- Pushy Menu -->
	<nav class="pushy pushy-right">
		<ul class="list-group">
			@if (Auth::guest())
			<li>
				<p>You are currently not signed in</p>
			</li>
			<li class="pushy-link">
				<a href="{{ url('/login') }}">Login</a>
			</li>
			<li class="pushy-link">
				<a href="{{ url('/register') }}">Register</a>
			</li>
			@else
			<li>
				<p>Logged in as {{Auth::user()->name}}</p>
			</li>
			<li class="pushy-link">
				<a href="{{ url('/logout') }}">Logout</a>
			</li>
			@endif
		</ul>
	</nav>

	<!-- Site Overlay -->
	<div class="site-overlay"></div>

	<!-- Your Content -->
	<div id="container-fluid">

		<nav class="navbar navbar-light bg-faded">
			<div class="nav navbar-nav pull-xs-left">
				<a class="navbar-brand" href="/"><strong>Wolpertinger Games</strong> | Build Distribution</a>
			</div>
			<div class="nav navbar-nav pull-xs-right">
				<a class="nav-link active pushy-enable-btn">&#9776; Menu</a>
			</div>
		</nav>
	</div>

	<div class="container-fluid ">
		<div class="row">
			@if (Auth::guest())
			<div class="col-md-12 single-content">
				@yield('content')
			</div>
			@else
			<div class="col-md-4 projects-list side-nav">
				@include('shared.projectMenu') @yield('projectMenu')
			</div>
			<div class="col-md-8 builds-view ">
				@yield('mainView')
			</div>
		</div>
		@endif
	</div>


	<!-- JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
	<script src="{{url('js/pushy.min.js')}}"></script>
</body>

</html>