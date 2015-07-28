<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;

use App\Project;
use App\Build;

class BuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($projectId)
    {
        $project = Project::getByIdOrName($projectId);
        $buildList = $project->build->all();

        return view('build/index', compact('project','buildList'));
    }

    public function indexSearch($projectId, $search)
    {
        $project = Project::getByIdOrName($projectId);
        $buildList = Build::ident($project->id , $search)->get();

        return view('build/index', compact('project','buildList'));
    }

    public function indexHead($projectId)
    {
        $project = Project::getByIdOrName($projectId);

        $buildList = Build::whereIn('platform',function($query){
                $query->from('build')
                    ->select('platform')
                    ->groupBy('platform');
            })->groupBy('platform')->get();

        return view('build/index', compact('project','buildList'));
    }

    public function showPlatformHead($projectId, $platform)
    {
        $project = Project::getByIdOrName($projectId);
        $build = Build::where('project_id', $project->id)
                        ->where('platform', $platform)
                        ->first();

        return view('build/show', compact('project', 'build'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($projectId)
    {
        $project = Project::getByIdOrName($projectId);

        return view('build/create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($projectId, Requests\BuildRequest $request)
    {        
        $project = Project::getByIdOrName($projectId);

        $project->build()->create($request->all());

        return Redirect::action('BuildController@index', $projectId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($projectId, $buildId)
    {
        $project = Project::getByIdOrName($projectId);
        $build = $project->build()->find($buildId);

        return view('build/show', compact('project', 'build'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($projectId, $buildId)
    {
        $project = Project::getByIdOrName($projectId);
        $build = $project->build()->find($buildId);

        return view('build/edit', compact('project', 'build'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($projectId, Requests\BuildRequest $request, $buildId)
    {
        $project = Project::getByIdOrName($projectId);
        $build = $project->build()->find($buildId);

        $build->update($request->all());

        return Redirect::action('BuildController@index', $projectId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($projectId, $buildId)
    {
        $project = Project::getByIdOrName($projectId);
        $build = $project->build()->find($buildId);

        $build->delete();

        return Redirect::action('BuildController@index', $projectId);
    }
}
