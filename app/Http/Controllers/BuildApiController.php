<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Response;

use App\Project;
use App\Build;

class BuildApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try
        {
            $buildList = Build::all();
            foreach($buildList as $build)
            {
                $this->patchProject($build);
            }

            return Response::json($buildList, 200);
        }
        catch (Exception $e)
        {
            return Response::json("{}", 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        try
        {
            return Response::json(200);
        }
        catch (Exception $e)
        {
            return Response::json("{}", 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\BuildApiRequest $request)
    {
        try
        {            
            $project = Project::getByIdOrName($request->input('project'));
            $build = $project->build()->create($request->all());

            return Response::json($build, 200);
        }
        catch (Exception $e)
        {
            return Response::json("{}", 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {        
        try
        {
            $build = Build::find($id);
            $this->patchProject($build);

            return Response::json($build, 200);
        }
        catch (Exception $e)
        {
            return Response::json("{}", 404);
        }
    }

    function patchProject($build)
    {
        $project = Project::find($build->project_id);
        $build->project = $project->name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try
        {
            return Response::json(200);
        }
        catch (Exception $e)
        {
            return Response::json("{}", 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\BuildApiRequest $request, $id)
    {
        try
        {
            $project = Project::getByIdOrName($request->input('project'));
            $build = $project->build()->find($id);
            $build->update($request->all());

            return Response::json($build, 200);
        }
        catch (Exception $e)
        {
            return Response::json("{}", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            $build = Build::find($id);

            $build->delete();

            return Response::json(200);
        }
        catch (Exception $e)
        {
            return Response::json("{}", 404);
        }
    }
}
