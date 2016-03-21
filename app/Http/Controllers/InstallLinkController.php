<?php

namespace App\Http\Controllers;

use Response;
use App\Helpers\AwsLinkService;
use App\Build;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class InstallLinkController extends Controller
{
	public function generateIphonePlist ($buildId)
	{
		$build = Build::find($buildId);
		
		$data = [
			'{%url%}' => url('/awsRedirect/'.$build->id),
			'{%bundleIdentifier%}' => $build->bundleIdentifier,
			'{%bundleVersion%}' => $build->iphoneBundleVersion,
			'{%iphoneTitle%}' => $build->iphoneTitle
		];
		
		// Using Laravels template system didn't work.
		// TODO: make this nicer :)
		$contents = "<?xml version='1.0' encoding='UTF-8'?>
					<!DOCTYPE plist PUBLIC ' -//Apple//DTD PLIST 1.0//EN' 'http://www.apple.com/DTDs/PropertyList-1.0.dtd'>
					<plist version='1.0'>
					<dict>
						<key>items</key>
						<array>
							<dict>
								<key>assets</key>
								<array>
									<dict>
										<key>kind</key>
										<string>software-package</string>
										<key>url</key>
										<string>{%url%}</string>
									</dict>
								</array>
								<key>metadata</key>
								<dict>
									<key>bundle-identifier</key>
									<string>{%bundleIdentifier%}</string>
									<key>bundle-version</key>
									<string>{%bundleVersion%}</string>
									<key>kind</key>
									<string>software</string>
									<key>title</key>
									<string>{%iphoneTitle%}</string>
								</dict>
							</dict>
						</array>
					</dict>
					</plist>";

		foreach ($data as $key => $value) {
			$contents = str_replace($key, $value, $contents);
		}
		
		$fileName = $build->installFileName.".app.plist";
		$headers = ['Content-type'=>'application/xml', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $fileName),'Content-Length'=>strlen($contents)];
		
		return Response::make($contents, 200, $headers);
	}
	
	public function getAwsAndRedirect ($buildId)
	{
		$build = Build::find($buildId);
		
		if (!$build) {
			abort(404);
		}
		
		$link = AwsLinkService::getPresignedLink($build->installFolder, $build->installFileName);
		
		return redirect()->intended($link);
	}
}
