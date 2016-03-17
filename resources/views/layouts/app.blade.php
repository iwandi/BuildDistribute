<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Build Distribution</title>

	<!-- Fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
	<link href="/css/styles.css" rel="stylesheet">

</head>

<body id="app-layout">
	
	<div class="container-fluid override">
		
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-light bg-faded">
					<a class="navbar-brand pull-xs-left" href="{{ url('/') }}">
						<strong>Wolpertinger Games</strong> | Build Distribution
					</a>
					<button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
						&#9776;
					</button>
					<div class="collapse navbar-toggleable-xs pull-xs-right" id="collapsingNavbar">
						<ul class="nav navbar-nav">
							@if (Auth::guest())
								<li class="nav-item">
									<a class="nav-link" href="{{ url('/login') }}">Login</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ url('/register') }}">Register</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link"><strong>Logged in as '{{Auth::user()->name}}'</strong></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ url('/logout') }}">Logout</a>
								</li>
							@endif
						</ul>
					</div>
				</nav>
			</div>
		</div>
		
		@if (Auth::guest())
			<div class="col-md-12 single-content">
				@yield('content')
			</div>
		@else
		<div class="row fill">
			<div class="wrapper">
				<div class="col-md-4" >
					<br>
					@include('shared.projectMenu') @yield('projectMenu')
				</div>
				<div class="col-md-8 builds-list">
					<br>
					@yield('mainView')
				</div>
			</div>
		</div>
		@endif
		
	</div>

	<!-- JavaScripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>

</html>