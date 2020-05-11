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
        $input = Projects::latest()->first();
        $project_details = ProjectDetails::create(['projects_id' => $input['id']]);
        $rewards = Rewards::create([
            'projects_id' => $input['id'], 
            'amount' => '1000', 
            'title' => 'Ma Contrepartie Test', 
            'description' => 'Vous devez donné des détails très 
            clair sur ce que les contributeurs gagnent en contribuant 
            avec le montant ci-dessus. N\'oublier pas la date de la 
            livraison , que ce soit un bien matériel ou non.'
            ]);
        $bank_statuses = BankStatuses::create(['projects_id' => $input['id']]);
        $communities = Communities::create(['projects_id' => $input['id']]);
        
        return response()->json($project, 201);
    }


    public function validateProject($id)
    {    
        $project = Projects::findOrFail($id);
        $date = Carbon::now();
        $project['duration'] = $date->addDays($project['duration'])->toDateString(); 
        $project['valider'] = 1; 
        $project->save();
        // $project = Projects::update($project); 
        return response()->json($project, 200);
    }


    public function updateProjectById(Request $request, $id)
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
