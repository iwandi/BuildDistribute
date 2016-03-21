@extends('layouts.app') @section('mainView')
@if (isset($build) && count($build) > 0)
	<div class="card">
		<div class="card-header">
			Build # {{$build->buildNumber}}
			@if (strtolower($build->platform) == 'android')
			<a href="{!!AwsLinkService::getPresignedLink($build->installFolder, $build->installFileName)!!}" class="card-link pull-xs-right">
				Install
			</a>
			@elseif (strtolower($build->platform) == 'iphone')
			<a href="itms-services://?action=download-manifest&url={!!url('/plist/'.$build->id.'.plist')!!}" class="card-link pull-xs-right">
			Install
			@endif
		</div>
		<div class="container">
			<br>
			<table class="table table-striped table-sm">
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
					<tr>
						<th>Received at</th>
						<td>{{date_format($build->created_at, 'g:ia\, jS F Y')}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@else
<div class="card card-inverse card-danger">
	<div class="card-block">
		<h3 class="card-title">No builds found</h3>
	</div>
</div>
@endif @endsection