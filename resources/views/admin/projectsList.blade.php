@extends('layouts.app') @section('mainView')
@if (isset($projects) && count($projects) > 0)
@foreach ($projects as $key=>$project)
<div class="card">
	<div class="card-header text-white card-inverse card-primary">
		<div class="row">
			<div class="col-md-12">
				<label><h5>{{$project->name}}</h5></label>
				<div class="btn-group pull-xs-right">
					<a href="{!!url('/projects/'.$project->name.'/edit')!!}"  class="btn btn-secondary-outline btn-sm white-outline">
						Edit Project
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid p-t-1">
		<label><strong>Users with access permission</strong></label>
		<div class="btn-group pull-xs-right">
			<a href="{!!url('/projects/'.$project->name.'/edit')!!}"  class="btn btn-primary-outline btn-sm">
				Grant access to user
			</a>
		</div>
		<div class="table-responsive m-t-1">
			<table id="usersTable" class="table table-striped table-sm table-bordered">
				<thead>
					<tr>
						<th class="text-xs-center">Name</th>
						<th class="text-xs-center">Email</th>
						<th class="text-xs-center">Role</th>
						<th class="text-xs-center">Role Description</th>
						<th class="text-xs-center"></th>
					</tr>
				</thead>
				<tbody class="text-xs-center">
				<?php $projectUsers = $project->users(); ?>
				@if (isset($projectUsers) && count($projectUsers) > 0)
					@foreach ($projectUsers as $key=>$user)
					<tr>
						<td>{{$user->name or 'N/A'}}</td>
						<td>{{$user->email or 'N/A'}}</td>
						<td>{{$user->role->name or 'N/A'}}</td>
						<td>{{$user->role->description or 'N/A'}}</td>
						<td>
							<form action="{{url('/admin/permissions/revoke')}}" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="userId" value={{$user->id}}>
								<input type="hidden" name="projectId" value={{$project->id}}>
								<input type="submit" value="Revoke" class="btn btn-danger btn-sm">
							</form>
						</tr>
					@endforeach
				@else
					<tr>
						<td>-</td>
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
@endforeach
@endif
@endsection