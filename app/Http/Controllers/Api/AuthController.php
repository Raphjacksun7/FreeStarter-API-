<?php

namespace App\Http\Controllers\Api;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /** 
     * Login Api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

        public function index()
        {
            $users = Users::all();
            return response()->json($users, 200);
        }

        public function login(Request $request){ 

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                //'remember_me' => 'boolean'
            ]);

            $credentials = request(['email', 'password']);

            if(Auth::attempt($credentials)){ 
                $user = $request->user(); 
                $tokenResult = $user->createToken('AccessToken');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                ]);
            } 
            else{ 
                return response()->json(['error'=>'Your email or password is correct, try agian'], 401); 
            } 
        }

    /** 
     * Register Api 
     * 
     * @return \Illuminate\Http\Response 
     */

        public function register(Request $request)  { 

             $request->validate([ 
                'name' => 'required|max:255', 
                'email' => 'email|required|unique:users', 
                'password' => 'required',  
            ]);
            
            $input = $request->all(); 
            $input['password'] = bcrypt($input['password']); 
            $user = Users::create($input); 
            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);
        }
    /** 
     * Details Api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

        public function user(Request $request)
        {
            return response()->json($request->user());
        }


        public function getUserById($id)
        {
            $user = Users::FindOrFail($id);
            return response()->json($user, 200);
        }


        public function logout(Request $request) 
        { 
            $request->user()->token()->revoke();
            return response()->json(['message' => 'Successfully logged out']); 
        } 

        public function delete($id) 
        { 
            $projects = Projects::where('user_id', $id)->get();
            foreach($project->id as $project_id){
                ProjectDetails::where('user_id', $project_id)->delete();
                Rewards::where('user_id', $project_id)->delete();
                Contributors::where('user_id', $project_id)->delete();
                BankStatuses::where('user_id', $project_id)->delete();
                Communities::where('user_id', $project_id)->delete();
            }
            Projects::where('user_id', $id)->delete();
            Users::findOrFail($id)->delete();

            return response()->json('This user is sucessfully deleted !', 204);
        }
        
    }