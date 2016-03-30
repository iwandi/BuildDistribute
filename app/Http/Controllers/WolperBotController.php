<?php

namespace App\Http\Controllers;


use App\Http\Controllers\InstallLinkController;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Exceptions\CustomException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Build;
use App\Project;

class WolperBotController extends Controller
{
	// TODO: Clean this monolith up!
	public function talk(Request $request, $roomId, $roomToken)
	{
		try {
			$data = $request->all();
						
			if (!$data) {
				throw new CustomException("No request body provided", 200);
			}
		
			$message = preg_split('/\s+/', $data['item']['message']['message']);
			
			$params = [];
			
			// Sneaky PHP, spaces get counted after the split but not inserted as nodes in the list
			foreach ($message as $a=>$b){    
				if (trim($b)) {
					$params[] = $b;
				}
			}
			
			if (count($params) < 2) {
				throw new CustomException("Hello there. \n\nNeed some help? Try '\\get help'", 200);
			}
			
			switch ($params[1]) {
				case 'help':
					// TODO: Rework this as method
					throw new CustomException("You can ask me for builds this way:".
											"\n'\\get  projectIdent  platform  buildId'".
											"\n\nIf you leave out the buildId I will get the head for that platform"
											, 200);
					break;
					
				case 'projects':
					$projects = Project::all();
					
					$projectInfo = ['I found this projects:'];
					
					foreach ($projects as $key => $project) {
						$projectInfo[] = "Name: ".$project->name."  |  Ident: ".$project->ident;
					}
					
					// TODO: Rework this as method
					throw new CustomException(implode("\n", $projectInfo), 200);
					break;
					
				default:
					break;
			}
			
						
			$projectIdent = isset($params[1]) ? $params[1] : null;
			$platform = isset($params[2]) ? $params[2] : null;
			$buildId = isset($params[3]) ? $params[3] : null;
			
			$project = Project::where("ident", "=", $projectIdent)->first();
			
			if (!$project) {
				// Exception needs to be 200 for hipchat to show the message on the chat
				throw new CustomException("I couldn't find any project with that ident", 200);
			}
			
			if (!$platform) {
				throw new CustomException("I can't guess for which platform you want me to get, tell me!", 200);
			}

			if (!preg_match("/^(ios|android|iphone)$/", strtolower($platform))) {
				throw new CustomException("You need to be more clear for which platform you want me to get. \nI have builds for ios and android", 200);
			}
			
			if (preg_match("/^(ios|iphone)/", strtolower($platform))) {
				throw new CustomException("Oh snap that build is for iOS! I currently only support android builds...", 200);
			}
			
			$installLinkController = new InstallLinkController();
			
			if (!$buildId) {
				$build = Build::where('project_id', '=', $project->id)->where('platform', '=', strtolower($platform))->orderBy("created_at", 'desc')->first();
				
				if (!$build) {
					throw new CustomException("Hm... I couldn't find any build for that project... ", 200);
				}
				
				$buildId = $build->id;
			}
			
			$link = $installLinkController->generatePublicLinkForBuild($buildId);
			
			if (!$link) {
				throw new CustomException("Hm... I couldn't find that build... ", 200);
			}
			
			// If everything went well, post to chat room
			$client = new Client;
			$client->request('POST', 'https://wolpertingergames.hipchat.com/v2/room/'.$roomId.'/notification?auth_token='.$roomToken, [
				"form_params" => [
					"color" => "green",
					"message" =>  $link,
					"notify" => false,
					"message_format" => "text"
				]
			]);
		}
		catch (\Exception $e)
        {
			$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
            return response()->json([
				'message' => $e->getMessage(),
				"color" => "red",
				"notify" => false,
				"message_format" => "text"
			], $statusCode);
        }
		
		return response()->json(200);
	}
}
