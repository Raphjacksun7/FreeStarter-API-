<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankStatuses;
use Illuminate\Http\Request;

class BankStatusesController extends Controller
{

    public function store(Request $request)
    {
        $bank = BankStatuses::create($request->all());
        return response()->json($bank, 201);
    }


    public function getBankInfoById($id)
    {
        $bank = BankStatuses::FindOrFail($id);
        return response()->json($bank, 201);
    }

    public function getBankInfoByProjectId($projectId)
    {
        $bank = BankStatuses::where('projects_id', $projectId)->first();

        return response()->json('communities', 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBankInfoByProjectId(Request $request, $projectId)
    {
        $bank = BankStatuses::where('projects_id', $projectId)->first();
        $bank->update($request->all());

        return response()->json($bank, 200);
    }
}
