<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        	<a class="navbar-brand" href="/">Build Deploy</a>
        </div>
        <div>
        	<ul class="nav navbar-nav">
        		<li><a href="/project">Project</a></li>
        	</ul>
            @if (!\Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/auth/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="/auth/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            @else
            <ul class="nav navbar-nav navbar-right">
                <li><a>{{ \Auth::user()->name }}</a></li>
                <li><a href="/auth/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
            @endif
        </div>
    </div>
</nav>