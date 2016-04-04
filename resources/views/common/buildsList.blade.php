@extends('layouts.app') @section('mainView')
<div class="card soft-shadow">
	
	<div class="card-header card-inverse card-primary">
		<div class="row">
			<div class="col-md-12">
				@if (isset($project))
				<div class="btn-group p-l-1 pull-xs-right">
					<label><a href="{{url('projects/'.$project->name.'/edit')}}" class="btn btn-secondary-outline btn-sm white-outline">Edit Project</a></label>
				</div>
				<div id="platformRadio" class="btn-group pull-xs-right" data-toggle="buttons">
					<label class="btn btn-secondary-outline btn-sm white-outline active">
						<input type="radio" name="options" id="all" autocomplete="off" checked>All</input>
					</label>
					<label class="btn btn-secondary-outline btn-sm white-outline">
						<input type="radio" name="options" id="iphone" autocomplete="off">iOS</input>
					</label>
					<label class="btn btn-secondary-outline btn-sm white-outline">
						<input type="radio" name="options" id="android" autocomplete="off">Android</input>
					</label>
				</div>
				<div class="text-xs-left text-white">
					<h5>Builds: {{count($project->builds)}}</h5>
				</div>
				@else
				<div class="text-xs-left text-white">
					<h5>No project selected</h5>
				</div>
				@endif
			</div>
		</div>
	</div>
	
	<div class="container-fluid p-t-1">
		<div class="table-responsive">
			<table id="buildsTable" class="table table-striped table-sm table-bordered">
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
					<?php $buildPlatform = strtolower($build->platform); ?>
					<tr id="{{$buildPlatform}}">
						<td>{{$build->buildNumber or 'N/A'}}</td>
						<td>{{$build->revision or 'N/A'}}</td>
						<td>
							{!!$buildPlatform == 'android' ? '<i class="fa fa-android"></i>' : '<i class="fa fa-apple"></i>'!!}
						</td>
						<td><a href="{{url('/builds/'.$build->id)}}">Details</a></td>
						<td>
							@if ($buildPlatform == 'android')
							<a href="{!!url('/downloads/builds/'.$build->id)!!}">Install</a>
							@elseif ($buildPlatform == 'iphone')
							<a href="itms-services://?action=download-manifest&url={!!url('/downloads/plist/'.$build->id.'/token/'.ViewService::generateUrlSafeToken())!!}">Install</a>
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
</div>
@endsection