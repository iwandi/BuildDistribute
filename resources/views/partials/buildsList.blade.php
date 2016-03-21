@extends('layouts.app') @section('mainView')
<div class="card">
	<div class="card-header card-inverse card-primary">
		<p class="text-xs-left text-white">
			@if (isset($commonData['resourceInPath']))
			<?php $projectInPath = $commonData['resourceInPath']; ?>
				<a href="{{url('projects/'.$projectInPath->name.'/edit')}}"><button type="button" class="btn btn-secondary-outline btn-sm pull-xs-right white-outline">Edit</button></a>
				ID: {{$projectInPath->id}} | Identifier: {{$projectInPath->ident}}
			@else
				No Project selected
			@endif
		</p>
	</div>
	<div class="container-fluid">
		<br>
		<table class="table table-striped table-sm table-bordered">
			<thead>
				<tr>
					<th class="text-xs-center">#</th>
					<th class="text-xs-center">Revision</th>
					<th class="text-xs-center">Platform</th>
					<th class="text-xs-center"></th>
					<th class="text-xs-center"></th>
				</tr>
			</thead>
			<tbody class="text-xs-center">
			@if (isset($builds) && count($builds) > 0)
				@foreach ($builds as $key=>$build)
				<tr>
					<td>{{$build->buildNumber or 'N/A'}}</td>
					<td>{{$build->revision or 'N/A'}}</td>
					<td>
						@if (strtolower($build->platform) == 'android')
						<i class="fa fa-android"></i>
						@elseif (strtolower($build->platform) == 'iphone')
						<i class="fa fa-apple"></i>
						@endif
					</td>
					<td><a href="{{url('builds/'.$build->id)}}">Details</a></td>
					<td>
						@if (strtolower($build->platform) == 'android')
						<a href="{!!AwsLinkService::getPresignedLink($build->installFolder, $build->installFileName)!!}">Install</a>
						@elseif (strtolower($build->platform) == 'iphone')
						<a href="itms-services://?action=download-manifest&url={!!url('/plist/'.$build->id.'.plist')!!}">Install</a>
						@endif
					</td>
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
@endsection