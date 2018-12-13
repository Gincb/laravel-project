<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'projects'], function () {
    Route::get('/', 'API\\ProjectController@getPaginate');
    Route::get('full', 'API\\ProjectController@getFullData');
    Route::get('one/{project}', 'API\\ProjectController@getById');

});

Route::group(['prefix' => 'objectives'], function () {
    Route::get('/', 'API\\ObjectiveController@getPaginate');
    Route::get('full', 'API\\ObjectiveController@getFullData');
    Route::get('one/{objective}', 'API\\ObjectiveController@getById');
});

Route::group(['prefix' => 'plans'], function () {
    Route::get('/', 'API\\PlanController@getPaginate');
    Route::get('one/{plan}', 'API\\PlanController@getById');
});

Route::group(['prefix' => 'teams'], function () {
    Route::get('/', 'API\\TeamController@getPaginate');
    Route::get('full', 'API\\TeamController@getFullData');
    Route::get('one/{team}', 'API\\TeamController@getById');
});

Route::group(['prefix' => 'members'], function () {
    Route::get('/', 'API\\MemberController@getPaginate');
    Route::get('one/{member}', 'API\\MemberController@getById');
});