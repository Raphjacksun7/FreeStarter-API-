<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Communities;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $communities = Communities::create($request->all());
        return response()->json($communities, 201);
    }


    public function getCommunitiesById($id)
    {
        $communities = Communities::FindOrFail($id);
        return response()->json($communities, 201);
    }

    public function getCommunitiesByProjectId($projectId)
    {
        $communities = Communities::where('projects_id', $projectId)->first();

        return response()->json($communities, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCommunitiesByProjectId(Request $request, $projectId)
    {
        $communities = Communities::where('projects_id', $projectId)->first();
        $communities->update($request->all());

        return response()->json($communities, 200);
    }

}
