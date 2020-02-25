<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Users;
use App\Models\Projects;
use App\Models\ProjectDetails;
use App\Models\Rewards;
use App\Models\Contributors;
use App\Models\BankStatuses;
use App\Models\Communities;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $project = Projects::all();
        return response()->json($project, 200);
    }

    public function getProjectById($project)
    {
        $project = Projects::FindOrFail($project);
        return response()->json($project, 200);
    }

    public function getProjectAllDetailsById($id)
    {
        $project = Projects::findOrFail($id);
        $users = Users::where('id', $project->user_id)->first();
        $project_details = ProjectDetails::where('projects_id', $id)->first();
        $rewards = Rewards::where('projects_id', $id)->get();
        $contributors = Contributors::where('projects_id', $id)->get();
        $bank_statuses = BankStatuses::where('projects_id', $id)->first();
        $communities = Communities::where('projects_id', $id)->first();

        return response()->json(compact('project','users','project_details', 'rewards','contributors','bank_statuses','communities'), 200);
    }

    public function getUserProjects($id)
    {
        $project = Projects::where('user_id',$id)->with(['users'])->get();
        return response()->json($project, 200);
    }

    public function store(Request $request)
    {    
        $project = Projects::create($request->all());

        return response()->json($project, 201);
    }


    public function validateProject($id)
    {    
        $project = Projects::findOrFail($id);
        $date = Carbon::now();
        $project['duration'] = $date->addDays($project['duration']); 
        $project['validate'] = 1; 
        $project = Projects::update($project); 

        return response()->json($project, 200);
    }


    public function updateProject(Request $request, $id)
    {
        $project = Projects::findOrFail($id);
        $project->update($request->all());

        return response()->json($project, 200);
    }

    public function deleteProjectById($id)
    {
        ProjectDetails::where('projects_id', $id)->delete();
        Rewards::where('projects_id', $id)->delete();
        Contributors::where('projects_id', $id)->delete();
        BankStatuses::where('projects_id', $id)->delete();
        Communities::where('projects_id', $id)->delete();
        Projects::findOrFail($id)->delete();

        return response()->json('Project sucessfully deleted !', 204);
    }
}
