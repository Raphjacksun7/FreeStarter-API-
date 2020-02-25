<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contributors;
use Illuminate\Http\Request;

class ContributorsController extends Controller
{
    
    public function store(Request $request)
    {
        $contributors = Contributors::create($request->all());
        return response()->json($bank, 201);
    }


    public function getContributorById($id)
    {
        $contributors = Contributors::FindOrFail($id);
        return response()->json($contributors, 201);
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
