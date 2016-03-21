@extends('layouts.app') @section('mainView')
<?php $projectInPath = $commonData['projectInPath']; ?>
@if (isset($projectInPath))
<p class="text-xs-left">
	<a href="{{url('projects/'.$projectInPath->name.'/edit')}}"><button type="button" class="btn btn-primary-outline btn-sm pull-xs-right">Edit</button></a>
	Project ID: {{$projectInPath->id}}, Project Ident: {{$projectInPath->ident}}
</p>
@endif
@if (isset($builds) && count($builds) > 0)
	@foreach ($builds as $key=>$build)
	<div class="card">
		<div class="card-header">
			<small class="text-muted">{{date_format($build->created_at, 'g:ia\, jS F Y')}}</small> @if (strtolower($build->platform)
			== 'android')
			<a href="{!!AwsLinkService::getPresignedLink($build->installFolder, $build->installFileName)!!}" class="card-link pull-xs-right">
				Install <i class="fa fa-android"></i>
			</a> @elseif (strtolower($build->platform) == 'iphone')
			<a href="itms-services://?action=download-manifest&url={!!url('/plist/'.$build->id.'.plist')!!}" class="card-link pull-xs-right">
			Install <i class="fa fa-apple"></i></a> @endif
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
						<th>Build #</th>
						<td>{{$build->buildNumber or 'N/A'}}</td>
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
						<th>Dist. ID</th>
						<td>{{$build->id or 'N/A'}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	@endforeach
@else
<div class="card card-inverse card-danger">
	<div class="card-block">
		<h3 class="card-title">No builds found</h3>
	</div>
</div>
@endif @endsection