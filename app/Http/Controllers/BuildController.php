<?php

namespace App\Http\Controllers;

use App\Helpers\AWSLinkService;
use App\User;
use App\Project;
use App\Build;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class BuildController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function show(Guard $auth, $projectId, $buildId)
	{
		$project = Project::findByIdOrName($projectId);
		$builds = $project->builds()->where('id', '=', $buildId)->get();
		
		return view('partials.builds', compact('builds'))->with('projects', Project::all());
	}
	
	public function generateIphonePlist($buildId)
	{
		$build = Build::find($buildId);
		
		// TODO: put actual values for AWS
		$data = [
			'url' => AWSLinkService::getAwsPreSignedLink($build->installFolder, $build->installFileName),
			'bundleIdentifier' => $build->bundleIdentifier,
			'bundleVersion' => $build->iphoneBundleVersion,
			'iphoneTitle' => $build->iphoneTitle
		];
				
        return view('assets.plist', ['data' => $data]);
	}
}
