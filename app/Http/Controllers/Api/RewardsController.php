<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rewards;
use Illuminate\Http\Request;

class RewardsController extends Controller
{


    public function getProjectRewardsById($id)
    {
        $rewards = Rewards::findOrFail($id);

        return response()->json( $rewards, 201);
    }

    public function getProjectRewardsByProjectId($id)
    {
        $rewards = Rewards::where('projects_id', $id)->get();

        return response()->json( $rewards, 201);
    }


    public function store(Request $request)
    {
        $reward = Rewards::create($request->all());

        return response()->json($reward, 201);
    }

    public function updateProjectRewardsById(Request $request, $id)
    {
        $reward = Rewards::findOrFail($id);
        $reward->update($request->all());

        return response()->json($reward, 200);
    }

    public function deleteProjectRewardsById($id)
    {
        Rewards::findOrFail($id)->delete();
        return response()->json('An Reward has been deleted ! ', 204);
    }
}
