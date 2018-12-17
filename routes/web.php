<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'Front\\HomeController@index')->name('home');

Route::get('projects', 'Front\\ProjectController@index')->name('front.projects');
Route::get('project/{slug}', 'Front\\ProjectController@show')->name('front.project.slug');

Route::get('members', 'Front\\MemberController@index')->name('front.members');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

    Route::get('/', 'AdminController@index')->name('admin.home');

    Route::resource('project', 'ProjectController');
    Route::resource('team', 'TeamController');
    Route::resource('objective', 'ObjectiveController');
    Route::resource('user', 'UserController')->only(['index']);
    Route::resource('member', 'MemberController')->except(['show', 'destroy']);
    Route::resource('plan', 'PlanController')->except(['show', 'destroy']);
});