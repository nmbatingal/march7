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

Route::post('/accounts/profile/{profile}/reset', 'Accounts\ProfileController@resetPassword')->name('profile.resetPassword');
Route::post('/accounts/profile/{profile}/update-password', 'Accounts\ProfileController@updatePassword')->name('profile.updatePassword');
Route::post('/accounts/profile/{profile}/update-user-roles', 'Accounts\ProfileController@updateUserRoles')->name('profile.updateUserRoles');
Route::resource('/accounts/profile', 'Accounts\ProfileController');
Route::resource('/accounts', 'Accounts\AccountsController');

Route::resource('/hrmis/application', 'Hrmis\ApplicantsController');
Route::resource('/hrmis', 'Hrmis\HrmisController');

Route::resource('/morss/survey/takesurvey', 'Morss\TakeSurveyController');
Route::resource('/morss/survey', 'Morss\SurveyController');
Route::post('/morss/{morss}/lock', 'Morss\MoraleSurveyController@lockSemester')->name('morss.lockSemester');
Route::post('/morss/{morss}/unlock', 'Morss\MoraleSurveyController@unlockSemester')->name('morss.unlockSemester');
Route::resource('/morss', 'Morss\MoraleSurveyController');

// Sample Query
Route::get('/sample', function () {
    
    /*$users = App\User::find(6)->with(['surveys' => function ($query) {
                $query->where('semester_id', '=', 1);
            }])->get();

    $user  = App\User::where('id', 6)->with(['surveys'])->first();

    $semester  = App\Models\Morss\MorssSemester::with(['surveys' => function ($query) {
                $query->where('semester_id', '=', 1)->first();
            }])->first();*/

    // $semester  = App\Models\Morss\MorssSemester::userHasSurveyed(1)->get();
    $semester  = App\Models\Morss\MorssSemester::userHasSurveyed(6)->paginate(10);

    $semesters = App\Models\Morss\MorssSemester::userSurveyed()->get();

    // return $user->surveys;
    return dd($semesters);
});
