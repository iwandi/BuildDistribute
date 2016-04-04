@extends('layouts.app') @section('mainView')
@if (isset($user))
@include('shared.editRoleModal') @yield('editRoleModal')
<div class="card soft-shadow">
	<div class="card-header text-white card-inverse card-primary">
		<div class="row">
			<div class="col-md-12">
				<label><h5>User Administration:</h5></label>
				<label class="m-l-1"><h6>Name: {{$user->name or 'N/A'}} | E-mail: {{$user->email or 'N/A'}} | Role: {{$user->role->name}}</h6></label>
				<div class="btn-group pull-xs-right">
					<a class="btn btn-secondary-outline btn-sm white-outline"  data-toggle="modal" data-target="#editRoleModal">
						Edit Role
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid p-t-1">
		<div class="table-responsive">
			<table id="projectsTable" class="table table-sm table-bordered">
				<thead>
					<tr>
						<th class="text-xs-center">ID</th>
						<th class="text-xs-center">Name</th>
						<th class="text-xs-center">Ident</th>
						<th class="text-xs-center"></th>
					</tr>
				</thead>
				<tbody class="text-xs-center">
					
				@if (isset($projects) && count($projects) > 0)
				<?php $projectsWithAccess = array_map(function($x) {return $x->id;}, $user->projects()); ?>
				
					@foreach ($projects as $key=>$project)
					<?php $hasAccess = in_array($project->id, $projectsWithAccess); ?>
					
					<tr @if ($hasAccess) class="table-success" @endif>
						<td>{{$project->id or 'N/A'}}</td>
						<td>{{$project->name or 'N/A'}}</td>
						<td>{{$project->ident or 'N/A'}}</td>
						<td>
							<form action="{{$hasAccess ? url('/admin/permissions/revoke') : url('/admin/permissions/grant')}}" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="userId" value={{$user->id}}>
								<input type="hidden" name="projectId" value={{$project->id}}>
								
								@if ($hasAccess)
								<input type="submit" value="Revoke" class="btn btn-danger btn-sm">
								@else 
								<input type="submit" value="Grant" class="btn btn-success btn-sm">
								@endif
								
							</form>
						</td>
					</tr>
					@endforeach
					
				@else
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endif
@endsection