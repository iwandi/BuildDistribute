@extends('layouts.app') @section('mainView')
@if (isset($builds) && count($builds) > 0)
	@foreach ($builds as $key=>$build)
	<div class="card">
		<div class="card-header">
			<small class="text-muted">Received on {{$build->created_at}}</small>
			@if ($build->platform == 'Android')
			<a href="{!!AwsLinkService::getAwsPreSignedLink($build->installFolder, $build->installFileName)!!}" class="card-link pull-xs-right">Install</a>
			@elseif ($build->platform == 'iPhone')
			<a href="itms-services://?action=download-manifest&url={!!url('/plist/'.$build->id)!!}" class="card-link pull-xs-right">Install</a>
			@endif
		</div>
		<div class="card-block">
			<span class="label label-default pull-xs-right">Platform: {{$build->platform or 'N/A'}}</span>
			<h5>Build #{{$build->buildNumber}}</h5>
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">Revision: {{$build->revision or 'N/A'}}</li>
		</ul>
	</div>
	@endforeach
@else
<div class="card-group">
	<div class="card card-inverse card-warning">
		<div class="card-block">
			<h5 class="card-title">No builds found</h5>
		</div>
	</div>
</div>
@endif
@endsection
