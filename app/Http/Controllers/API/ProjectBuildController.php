<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;
use App\Exceptions\CustomException;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Build;
use App\Project;

class ProjectBuildController extends Controller
{
	/**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index($projectId)
    {
		try
        {
            $project = Project::findByIdOrName($projectId);
			
			if ($project) {
				$builds = $project->builds;
				return response()->json($builds, 200);
			}
			else {
				throw new CustomException("Provided project id or name not found",404);
			}
        }
		catch (\Exception $e)
        {
			$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
            return response()->json([
				'errors' => ['message' => $e->getMessage()]
			], $statusCode);
        }
	}
	
	/**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($projectId, $buildId)
    {
		try
        {
            $build = Build::find($buildId);
			if ($build) {
            	return response()->json($build, 200);
			}
			else {
				throw new CustomException("Provided build id not found",404);
			}
        }
		catch (\Exception $e)
        {
			$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
            return response()->json([
				'errors' => ['message' => $e->getMessage()]
			], $statusCode);
        }
	}
	
	public function indexHead(Request $request, $projectId)
	{
		// Get route query parameters if any
		$platform = $request->input('platform');
		
		try
        {
            $project = Project::findByIdOrName($projectId);
			
			if ($project) {
											
				if ($platform) {
					$head = $project->builds()
						->where('platform', $platform)
						->orderBy('created_at', 'desc')
						->first();
				}
				else {
					// TODO: cleanup query with Laravel's query builder
					// NOTE: it must return the head build for each platform in one json
					// Get head for all platforms in one query
					$head = DB::table(DB::raw("(SELECT sub.platform, MAX(sub.revision) AS head
												FROM (SELECT * FROM builds WHERE project_id = ".$project->id.") sub
												GROUP BY platform) as filtered
												INNER JOIN builds temp ON temp.platform = filtered.platform
												AND temp.revision = filtered.head;"))
												->get();
				}
				
				return response()->json($head, 200);
			}
			else {
				throw new CustomException("Provided project id or name not found",404);
			}
        }
		catch (\Exception $e)
        {
			$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
            return response()->json([
				'errors' => ['message' => $e->getMessage()]
			], $statusCode);
        }
	}
	
    // public function store(Request $request, $projectId)
    // {
    //     try
    //     {
	// 		$input = $request->all();
			
	// 		$validator = Validator::make($input, [
	// 			'install_url' => 'required',
	// 			'revision' => 'required',
	// 			'platform' => 'required'
	// 		]);
			
	// 		if ($validator->fails()) {
	// 			return response()->json([
	// 				'errors' => $validator->errors()
	// 			], 400);
	// 		}
			
    //         $project = Project::findByIdOrName($projectId);
			
	// 		if ($project) {
    //         	$build = $project->builds->create($input);
	// 		}
	// 		else {
	// 			throw new CustomException("Provided project id or name not found, you must specify an "
	// 								."existing project to associate with this built", 404);
	// 		}

    //         return response()->json($build, 200);
    //     }
	// 	catch (\Exception $e)
    //     {
	// 		$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
    //         return response()->json([
	// 			'errors' => ['message' => $e->getMessage()]
	// 		], $statusCode);
    //     }
    // }
}
