<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'Api\AuthController@logout');
    Route::get('user', 'Api\AuthController@user');
});

// Projects

Route::get('getProjects/', 'Api\ProjectsController@index');
Route::get('getProjectById/{id}', 'Api\ProjectsController@getProjectById');
Route::get('getProjectAllDetailsById/{id}', 'Api\ProjectsController@getProjectAllDetailsById');
Route::get('getUserProjects/{userId}', 'Api\ProjectsController@getUserProjects');
Route::post('createProject', 'Api\ProjectsController@store');
Route::put('updateProjectById/{id}', 'Api\ProjectsController@update');
Route::put('validateProject/{id}', 'Api\ProjectsController@validateProject');
Route::delete('deleteProjectById/{id}', 'Api\ProjectsController@delete');


// Projects Details

Route::get('getProjectDetailsByProjectId/{projectId}', 'Api\ProjectDetailsController@getProjectDetailsByProjectId');
Route::get('getProjectDetailsById/{id}', 'Api\ProjectDetailsController@getProjectDetailsById');
Route::post('addProjectDetails', 'Api\ProjectDetailsController@store');
Route::put('updateProjectDetailsByProjectId/{project}', 'Api\ProjectDetailsController@updateProjectDetailsByProjectId');

// Images

Route::get('getImage/{filename}', 'Api\ImagesController@getImage');


// Communities

Route::get('getCommunitiesByProjectId/{projectId}', 'Api\CommunitiesController@getCommunitiesByProjectId');
Route::get('getCommunitiesById/{id}', 'Api\CommunitiesController@getCommunitiesById');
Route::post('addCommunities', 'Api\CommunitiesController@store');
Route::put('updateCommunitiesByProjectId/{projectId}', 'Api\CommunitiesController@updateCommunitiesByProjectId');


// Contributors

Route::get('getContributorById/{id}', 'Api\ContributorsController@getContributorById');
Route::get('getContributorByProjectId/{projectId}', 'Api\ContributorsController@getContributorByProjectId');
Route::post('saveContributor', 'Api\ContributorsController@store');


// Rewards

Route::get('getProjectRewardsById/{id}', 'Api\RewardsController@getProjectRewardsById');
Route::get('getProjectRewardsByProjectId/{projectId}', 'Api\RewardsController@getProjectRewardsByProjectId');
Route::post('addProjectReward', 'Api\RewardsController@store');
Route::put('updategetProjectRewardsById/{id}', 'Api\RewardsController@updategetProjectRewardsById');
Route::delete('deleteProjectRewardsById/{id}', 'Api\RewardsController@deleteProjectRewardsById');


// BankStatuses

Route::get('getBankInfoById/{id}', 'Api\BankStatusesController@getBankInfoById');
Route::get('getBankInfoByProjectId/{projectId}', 'Api\BankStatusesController@getBankInfoByProjectId');
Route::post('saveProjetBankInfo', 'Api\BankStatusesController@store');
Route::put('updateBankInfoByProjectId/{projectId}', 'Api\BankStatusesController@updateBankInfoByProjectId');
