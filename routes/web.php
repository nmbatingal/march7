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
Route::resource('/logs', 'UserLogsController');

Route::resource('/accounts/permissions', 'Roles\PermissionController');
Route::resource('/accounts/roles', 'Roles\RoleController');

Route::post('/accounts/profile/{profile}/reset', 'Accounts\ProfileController@resetPassword')->name('profile.resetPassword');
Route::post('/accounts/profile/{profile}/update-password', 'Accounts\ProfileController@updatePassword')->name('profile.updatePassword');
Route::post('/accounts/profile/{profile}/update-user-roles', 'Accounts\ProfileController@updateUserRoles')->name('profile.updateUserRoles');
Route::post('/accounts/{account}/restore', 'Accounts\AccountsController@restore')->name('accounts.restore');
Route::post('/accounts/import/users', 'Accounts\AccountsController@importUserFile');
Route::get('/accounts/template/download', 'Accounts\AccountsController@downloadTemplateFile');
Route::resource('/accounts/profile', 'Accounts\ProfileController');
Route::resource('/accounts', 'Accounts\AccountsController');


Route::resource('/hrmis/applicants', 'Hrmis\ApplicantsController');
Route::resource('/hrmis', 'Hrmis\HrmisController');

Route::resource('/empres', 'Empres\EmpresController');

Route::resource('/morss/survey/takesurvey', 'Morss\TakeSurveyController');
Route::resource('/morss/survey', 'Morss\SurveyController');
Route::post('/morss/{morss}/lock', 'Morss\MoraleSurveyController@lockSemester')->name('morss.lockSemester');
Route::post('/morss/{morss}/unlock', 'Morss\MoraleSurveyController@unlockSemester')->name('morss.unlockSemester');
Route::resource('/morss', 'Morss\MoraleSurveyController');

Route::get('/user', function() {
    $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with([
        'surveys' => function ($query) {
            $query->join('users', 'morss_surveys.user_id', '=', 'users.id')
                  ->where('users._isActive', 1);
        }
    ])->get();

    $remarks = App\Models\Morss\MorssSurveyRemarks::where('semester_id', $semesters->first() ? $semesters->first()->id : 0 )->orderBy('created_at', 'DESC')->get();

    return $remarks;
});

// Sample Query
Route::get('/sample', function () {

    // $semesters = App\Models\Morss\MorssSemester::surveyAvailable(true)->with('surveys')->get();
    // $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with('surveys')->get();
    // $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with('surveys')->get(); 
    $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with([
        'surveys' => function ($query) {
            $query->with('user')
                  ->join('users', 'morss_surveys.user_id', '=', 'users.id')
                  ->where('users._isActive', 1);
        }
    ])->get();
    // $overallIndex = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first() );
    // $overallIndex = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first(), Auth::user() );
    // $overallIndex = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first(), Auth::user(), 1 );
    $users   = App\User::staffUsers()->get();

    //$division_data[] = [ 'name' => 'OI', 'oi' => $overallIndex];
    /* $divisions     = ['ORD', 'FAS', 'FOD', 'TSS'];
    foreach ( $divisions as $division ) {

        $office       = App\Offices::where('acronym', '=', $division)->first();
        $overallIndex = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first(), $office->id, Auth::user() );
        $division_data[] = [ 'name' => $division, 'oi' => $overallIndex ];
    } */

    ////////
    $overallIndex = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first() );

    $division_data[] = [ 'name' => 'Overall Index', 'oi_value' => $overallIndex];
    $divisions       = ['ORD', 'FAS', 'FOD', 'TSS'];

    foreach ( $divisions as $division ) {

        $office       = App\Offices::where('acronym', '=', $division)->first();
        $division_oi  = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first(), $office );

        if ( empty($division_oi) )
        {
            $division_data[] = [ 'name' => $division, 'oi_value' => $division_oi[0] ];
        }
    }

    $newstring = 'PSTC-ADN';
    $pos = strpos($newstring, 'PSTC', 0); // $pos = 7, not 0

    $staffs    = App\User::staffUsers()->count();
    $questions = App\Models\Morss\MorssSurvey::questionMoraleIndex( $semesters->first() );

    // $office    = App\Offices::where('acronym', '=', 'TSS')->first();






    $semesters = App\Models\Morss\MorssSemester::orderBy('created_at', 'DESC')->surveyAvailable(true)->with([
        'surveys' => function ($query) {
            $query->join('users', 'morss_surveys.user_id', '=', 'users.id')
                  ->where('users._isActive', 1);
        }
    ])->get();

    $overallIndex    = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first() );
    $division_data[] = [ 'name' => 'Overall Index', 'oi_value' => $overallIndex];
    $divisions       = ['ORD', 'FAS', 'FOD', 'TSS'];

    foreach ( $divisions as $division ) {

        $office       = App\Offices::where('acronym', '=', $division)->first();
        $division_oi  = App\Models\Morss\MorssSurvey::overallIndex( $semesters->first(), $office );
        $division_data[] = [ 'name' => $division, 'oi_value' => $division_oi ];
        
    }

    $totalSurveyed = App\Models\Morss\MorssSurvey::totalUserSurveyed( $semesters->first() );
    return dd($semesters, $totalSurveyed, $division_data);

    // return dd($semesters->first());
    // return dd( $semesters, $overallIndex, $questions, $division_data, $users );
    // return dd($division_data);
    // return $pos;
    // return dd($staffs, $semesters);
});
