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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/accounts/permissions', 'Roles\PermissionController');
Route::resource('/accounts/roles', 'Roles\RoleController');

Route::post('/accounts/profile/{profile}/update-password', 'Accounts\ProfileController@updatePassword')->name('profile.updatePassword');
Route::post('/accounts/profile/{profile}/update-user-roles', 'Accounts\ProfileController@updateUserRoles')->name('profile.updateUserRoles');
Route::resource('/accounts/profile', 'Accounts\ProfileController');
Route::resource('/accounts', 'Accounts\AccountsController');

Route::resource('/hrmis/application', 'Hrmis\ApplicantsController');
Route::resource('/hrmis', 'Hrmis\HrmisController');

Route::resource('/morss/survey', 'Morss\SurveyController');
Route::resource('/morss', 'Morss\MoraleSurveyController');
