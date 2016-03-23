@extends('layouts.app') @section('mainView')
<div class="card">
	<div class="card-header text-white card-inverse card-primary">
		<div class="row">
			<div class="col-md-12">
				<label><h5>User Administration</h5></label>
				<!--<div class="btn-group pull-xs-right">
					<a href="{!!url('/admin/roles')!!}"  class="btn btn-secondary-outline btn-sm white-outline">
						Edit Roles
					</a>
				</div>-->
			</div>
		</div>
	</div>
	<div class="container-fluid p-t-1">
		<div class="table-responsive">
			<table id="usersTable" class="table table-striped table-sm table-bordered">
				<thead>
					<tr>
						<th class="text-xs-center">ID</th>
						<th class="text-xs-center">Name</th>
						<th class="text-xs-center">Email</th>
						<th class="text-xs-center">Role</th>
						<th class="text-xs-center">Projects</th>
						<!--<th class="text-xs-center"></th>-->
					</tr>
				</thead>
				<tbody class="text-xs-center">
				@if (isset($users) && count($users) > 0)
					@foreach ($users as $key=>$user)
					<tr>
						<td>{{$user->id or 'N/A'}}</td>
						<td>{{$user->name or 'N/A'}}</td>
						<td>{{$user->email or 'N/A'}}</td>
						<td>{{$user->role->name or 'N/A'}}</td>
						<td>{{implode (',', $user->projectNames())}}</td>
						<!--<td><a href="{!!url('/admin/users/'.$user->id)!!}" disabled>Edit User</a></td>-->
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
@endsection