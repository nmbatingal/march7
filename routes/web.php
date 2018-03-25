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

    // $semesters = App\Models\Morss\MorssSemester::surveyAvailable(true)->with('surveys')->get();

    // $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with('surveys')->get();

    // $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with('surveys')->get(); 

    $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with([
            /*'surveys.user.roles' => function ($query) {
                $query->select('morss_surveys.rate');
            }*/

            'surveys' => function ($query) {
                $query->join('users', 'morss_surveys.user_id', '=', 'users.id')
                      ->where('users._isActive', 1)
                      ->with([
                            'user' => function ($query) {
                                $query->staff();
                            }
                        ]); //->with('user.roles'); //->staff();
            }

        ])->get();

    $overallIndex = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first() );
    // $overallIndex = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first(), Auth::user() );

    $users   = App\User::staff()->get();
    // return dd($semesters->first());
    return dd( $semesters, $overallIndex, $users );
});
