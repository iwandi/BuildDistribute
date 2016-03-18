@section('projectMenu')
<a href="/projects/create">
	<div class="card">
		<div class="card-block">
			<h3 class="card-title"><i class="fa fa-plus"></i> New project</h3>
		</div>
	</div>
</a>
<?php $allowedProjects = $commonData['allowedProjects']; ?>
@if (isset($allowedProjects))
	@foreach ($allowedProjects as $project)
		<a href="/projects/{{$project->name}}">
			<div class="card {{Request::is('projects/'.$project->name.'*') || Request::is('projects/'.$project->id.'/*') ? 'card-inverse card-primary' : ''}}">
				<div class="card-block">
					<h3 class="card-title">
						<span class="label label-pill label-default ">{{$project->builds()->count()}}</span>
						{{$project->name or 'Unkown Project'}}
					</h3>
				</div>
			</div>
		</a>
	@endforeach
@else
	<div class="card">
		<div class="card-block">
			<h3>No projects assigned</h3>
		</div>
	</div>
@endif
@endsection