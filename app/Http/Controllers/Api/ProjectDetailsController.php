<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\ProjectDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectDetailsController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectDetails = null;
        $input = $request->all(); 
        $base64_image = $input['image'];
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $image = substr($base64_image, strpos($base64_image, ',') + 1);
            $image = base64_decode($image);
            $imageName = 'project-'.$input['projects_id'].'_'.Str::random(6).'.'.'png';
            //\File::put(storage_path(). '/public/' . $imageName, $image);
            Storage::disk('upload')->put($imageName, $image);
            $input['image'] = $imageName;
        }
        $projectDetails = ProjectDetails::create($input);
        return response()->json($projectDetails, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProjectDetailsById($id)
    {
        $projectDetails = ProjectDetails::FindOrFail($id);
        return response()->json($projectDetails, 201);
    }

    public function getProjectDetailsByProjectId($projectId)
    {
        $projectDetails = ProjectDetails::where('projects_id', $projectId)->first();

        return response()->json( $projectDetails, 201);
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProjectDetailsByProjectId(Request $request, $projectId)
    {
        $projectDetails = ProjectDetails::where('projects_id', $projectId)->first();
        $input = $request->all(); 
        $base64_image = $input['image'];
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $image = substr($base64_image, strpos($base64_image, ',') + 1);
            $image = base64_decode($image);
            $imageName = 'project-'.$input['projects_id'].'_'.Str::random(6).'.'.'png';
            //\File::put(storage_path(). '/public/' . $imageName, $image);
            Storage::disk('upload')->put($imageName, $image);
            $input['image'] = $imageName;
        }
        $projectDetails->update($input);

        return response()->json($projectDetails, 200);
    }


}
