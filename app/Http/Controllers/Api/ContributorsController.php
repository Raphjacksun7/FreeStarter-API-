<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contributors;
use App\Models\Rewards;
use App\Models\Projects;
use Illuminate\Http\Request;

class ContributorsController extends Controller
{
    
    public function store(Request $request)
    {
        $input = $request->all();
        $project = Projects::findOrFail($input['projects_id']);
        $reward = Rewards::findOrFail($input['projects_id']);

        if($project['contributors_number'] == null ) 
        $project['contributors_number'] = 0 ; 
        if($project['current_budget'] == null ) 
        $project['current_budget'] = 0 ;

        $project['current_budget'] = $project['current_budget'] + $reward['amount'];
        $project['contributors_number'] = $project['contributors_number'] + 1 ;
        $project['progression'] = floor(( $project['current_budget'] / $project['budget'] ) * 100 );

        $project->save();
        $contributors = Contributors::create($input);

        return response()->json($contributors, 201);
    }


    public function getContributorById($id)
    {
        $contributors = Contributors::FindOrFail($id);
        return response()->json($contributors, 201);
    }

    public function getUserContributons($idUser)
    {
        $contributors = Contributors::where('user_id',$idUser)->get();
        return response()->json($contributors, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getContributorsByProjectId($projectId)
    {
        $contributors = Contributors::where('projects_id', $projectId)->get();
        return response()->json($contributors, 201);
    }


}
