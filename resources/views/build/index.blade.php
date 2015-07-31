@extends('layouts.default')
@section('content')
	<div calss="container">
	    <h1>{{ $project->name }}</h1>

	    <a href="{{ action('ProjectController@edit', [$project->name]) }}" class="btn btn-default">Edit</a>
		<a href="{{ action('BuildController@create', [$project->name]) }}" class="btn btn-default">Add Build</a>

		@if ($buildTableView)
			@if (count($buildTableView))
				<div class="container">
					<table class="table">
						<thead>
							<tr>
								<th>Revision/Platform</th>
								@foreach($buildTableView["platformList"] as $platform)
									<th>{{ $platform }}</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach($buildTableView["buildTable"] as $revision => $revisionRow)
								<tr>
									<td>{{ $revision }}</td>
									@foreach($buildTableView["platformList"] as $platform)
										<?php 
										if (isset($revisionRow[$platform]))
										{
											$build = $revisionRow[$platform];
										}
										else 
										{
											$build = NULL;
										} ?>
										<td>
											@if ($build != NULL)
												{{ $build->version }}
												<a href="{{ route('project.build.show', ['projectId' => $project->name,'buildId' => $build->id]) }}" class="btn btn-default">Detail</a>
										    	@if ($build->platform == 'IPhone')
										            <a href="{{ $build->installUrl }}" class="btn btn-primary">Install // TODO</a>            
										        @else
										            <a href="{{ $build->installUrl }}" class="btn btn-primary">Download</a>
										        @endif
									        @endif
										</td>
									@endforeach
								</tr>	
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				No Builds
			@endif
		@else
		    @if (count($buildList))
		    	<ul>
			    @foreach ($buildList as $build)	    	    
				    <li>
				    	Platform: {{ $build->platform }}, Build Version: {{ $build->version }}, Revision: {{ $build->revision }}
				    	<a href="{{ route('project.build.show', ['projectId' => $project->name,'buildId' => $build->id]) }}" class="btn btn-default">Detail</a>
				    	@if ($build->platform == 'IPhone')
				            <a href="{{ $build->installUrl }}" class="btn btn-primary">Install // TODO</a>            
				        @else
				            <a href="{{ $build->installUrl }}" class="btn btn-primary">Download</a>
				        @endif
				    </li>
				@endforeach
				</ul>
			@else
				No Builds
			@endif
		@endif
	</div>    
@stop