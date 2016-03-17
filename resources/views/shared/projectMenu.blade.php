@section('projectMenu')
@if (isset($projects))
	@foreach ($projects as $project)
		<a href="/projects/{{$project->name}}">
			<div class="card {{Request::is('projects/'.$project->name.'*') || Request::is('projects/'.$project->id.'*') ? 'card-inverse card-primary' : ''}}">
				<div class="card-block">
					<span class="label label-default pull-xs-right">{{$project->builds()->count()}} builds</span>
					<h5 class="card-title">{{$project->name or 'Unkown Project'}}</h5>
				</div>
			</div>
		</a>
	@endforeach
@else
	<div class="card">
		<div class="card-block">
			<h5>No projects assigned</h5>
		</div>
	</div>
@endif
<a href="/projects/create">
	<div class="card">
		<div class="card-block">
			<h5 class="card-title">Add a new project</h5>
		</div>
	</div>
</a>
@endsection