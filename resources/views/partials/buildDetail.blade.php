@extends('layouts.app') @section('mainView')
@if (isset($build) && count($build) > 0)
	<div class="card">
		<div class="card-header text-white card-inverse card-primary">
			Build # {{$build->buildNumber}}
			@if (strtolower($build->platform) == 'android')
			<a href="{!!url('/awsRedirect/'.$build->id)!!}" class="pull-xs-right text-white">
				Install
			</a>
			@elseif (strtolower($build->platform) == 'iphone')
			<a href="itms-services://?action=download-manifest&url={!!url('/plist/'.$build->id.'.plist')!!}"  class="pull-xs-right text-white">
				Install
			</a>
			@endif
		</div>
		<div class="container-fluid">
			<br>
			<table class="table table-bordered table-sm">
				<tbody>
					<tr>
						<th>Revision</th>
						<td>{{$build->revision or 'N/A'}}</td>
					</tr>
					<tr>
						<th>Platform</th>
						<td>{{$build->platform or 'N/A'}}</td>
					</tr>
					<tr>
						<th>Bundle Identifier</th>
						<td>{{$build->bundleIdentifier or 'N/A'}}</td>
					</tr>
					<tr>
						<th>Version</th>
						<td>{{$build->version or 'N/A'}}</td>
					</tr>
					<tr>
						<th>ID</th>
						<td>{{$build->id or 'N/A'}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="card-footer text-muted">Received at {{date_format($build->created_at, 'g:ia \o\n l jS F Y')}}</div>
	</div>
@else
<div class="card card-inverse card-danger">
	<div class="card-block">
		<h3 class="card-title">No build found</h3>
	</div>
</div>
@endif @endsection