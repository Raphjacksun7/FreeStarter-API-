<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BankStatusesController extends Controller
{

    public function store(Request $request)
    {
        $bank = null;
        $input = $request->all(); 
        $zipFile = $request->file('statusProof');
        $path = public_path() . '/uploads/';
        $zipFile->move($path, $zipFile->getClientOriginalName() );
        $fileName = $zipFile->getClientOriginalName();
        $input['statusProof'] = $fileName;
        
        $bank = BankStatuses::create($input);
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

        return response()->json($bank, 201);
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
 
        $input = $request->all(); 
        $zipFile = $request->file('statusProof');
        if($request->hasFile('statusProof')) {
            
            $path = public_path() . '/uploads/';
            $zipFile->move($path, $zipFile->getClientOriginalName() );
            $fileName = $zipFile->getClientOriginalName();
            $input['statusProof'] = $fileName;
       }

        $bank->update($input);
        return response()->json($bank, 204);
    }


    
}
