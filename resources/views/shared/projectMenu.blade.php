@section('projectMenu')
@can('manageAll')
<a href="/projects/create">
	<div class="card">
		<div class="card-block">
			<h5 class="card-title"><i class="fa fa-plus"></i> Create project</h5>
		</div>
	</div>
</a>
@endcan
<?php $allowedProjects = $commonData['allowedProjects']; ?>
@if (isset($allowedProjects))
	@foreach ($allowedProjects as $project)
		<a href="/projects/{{$project->name}}">
			<div class="card {{Request::is('projects/'.$project->name.'*') || Request::is('projects/'.$project->id.'/*') ? 'card-inverse card-primary' : ''}}">
				<div class="card-block">
					<h5 class="card-title">
						<span class="label label-pill label-default ">{{$project->builds()->count()}}</span>
						{{$project->name or 'Unkown Project'}}
					</h5>
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
@endsection