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
				throw new CustomException("No request body provided", 400);
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
				return $this->sendMessage($roomId, $roomToken, "Hello there.".
																"<br><br>You can ask me for builds this way:".
																"<br><i>'\\get  projectIdent  platform  buildId'</i>".
																"<br><br>If you leave out the <i>buildId</i> I will get the head for that platform".
																"<br><br>You can also ask me which projects exists, like this:".
																"<br><i>'\\get projects'</i>"
																);
			}
			
			switch ($params[1]) {
				case 'projects':
					$projects = Project::all();
					
					$projectInfo = ["I found these projects:"];
					
					foreach ($projects as $key => $project) {
						$projectInfo[] = "&middot; Name: <i>".$project->name."</i>  |  Ident: <i>".$project->ident."</i>";
					}
										
					return $this->sendMessage($roomId, $roomToken, implode("<br>",  $projectInfo));
					
					break;
					
				default:
					break;
			}
			
						
			$projectIdent = isset($params[1]) ? $params[1] : null;
			$platform = isset($params[2]) ? $params[2] : null;
			$buildId = isset($params[3]) ? $params[3] : null;
			
			$project = Project::where("ident", "=", $projectIdent)->first();
			
			if (!$project) {
				return $this->sendMessage($roomId, $roomToken, "I couldn't find any project with that ident");
			}
			
			if (!$platform) {
				return $this->sendMessage($roomId, $roomToken, "I can't guess for which platform you want me to get, tell me!");
			}

			if (!preg_match("/^(ios|android|iphone)$/", strtolower($platform))) {
				return $this->sendMessage($roomId, $roomToken, "You need to be more clear for which platform you want me to get. have builds for <i>ios</i> and <i>android</i>");
			}
			
			if (preg_match("/^(ios|iphone)/", strtolower($platform))) {
				return $this->sendMessage($roomId, $roomToken, "Oh snap that build is for iOS! At the moment I only support <i>android</i> builds... Hint: plists...");
			}
			
			$installLinkController = new InstallLinkController();
			
			if (!$buildId) {
				$build = Build::where('project_id', '=', $project->id)->where('platform', '=', strtolower($platform))->orderBy("created_at", 'desc')->first();
				
				if (!$build) {
					return $this->sendMessage($roomId, $roomToken, "Hm... I couldn't find <i>any</i> build for that project... ");
				}
				
				$buildId = $build->id;
			}
			
			$link = $installLinkController->generatePublicLinkForBuild($buildId);
			
			if (!$link) {
				return $this->sendMessage($roomId, $roomToken, "Hm... I couldn't find that build... ");
			}
			
			// If everything went well, post to chat room
			return $this->sendMessage($roomId, $roomToken, "<a href=".$link.">Install ".$project->name." Build #".$buildId."</a>");
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
	
	function SendMessage($roomId, $roomToken, $message) {
		if (!$roomId || !$roomToken) {
			return;
		}
		
		$client = new Client;
		$client->request('POST', 'https://wolpertingergames.hipchat.com/v2/room/'.$roomId.'/notification?auth_token='.$roomToken, [
			"form_params" => [
				"color" => "green",
				"message" => $message,
				"notify" => false,
				"message_format" => "html"
			]
		]);
	}
}
