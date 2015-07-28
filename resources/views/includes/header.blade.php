<div class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Wlp Build Web</a>
            <div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				  <li class="active"><a href="#">Home</a></li>
				  <li class="active"><a href="{{ action('ProjectController@index') }}">Projects</a></li>				  
				  <li class="dropdown">
				    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
				    <ul class="dropdown-menu">
			            <li><a href="/auth/login">login</a></li>
			            <li><a href="/auth/register">registration</a></li>
			            <li><a href="/">logout</a></li>
				    </ul>
				  </li>
				</ul>
			</div><!--/.nav-collapse -->
	        <div class="nav-collapse collapse">
		        <ul class="nav">
		        </ul>
	    	</div>
	    </div>
    </div>
</div>