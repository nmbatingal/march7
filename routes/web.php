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

Route::resource('/accounts', 'Accounts\AccountsController');
Route::resource('/accounts/profile', 'Accounts\ProfileController');

Route::resource('/hrmis', 'Hrmis\HrmisController');
Route::resource('/hrmis/application', 'Hrmis\ApplicantsController');
