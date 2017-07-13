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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/report', 'EmployeeController@showReport');

// Route::get('/profile', 'EmployeeController@showProfile');
Route::get('profile', [
  'uses' => 'EmployeeController@showProfile',
  'as' => 'profile',
  ]);



Route::get('jquery-loadmore',['as'=>'jquery-loadmore','uses'=>'EmployeeController@showProfile']);

Route::get('/changepw', 'EmployeeController@showChangePw');
Route::get('/changeusername', 'EmployeeController@showChangeUsername');
Route::get('/evaluate', 'EmployeeController@showEvaluateAll');
Route::get('/evaluate/{id}', [
  'uses'       => 'EmployeeController@showEvaluate',
  'middleware' => ['auth'],
  ]);

Route::post('eval', [
  'uses' => 'EmployeeController@evaluate',
  'as' => 'emp.eval',
  ]);

Route::post('changePw/', [
  'uses' => 'EmployeeController@changePw',
  'as' => 'emp.chagePw',
  ]);

  Route::post('changeUsername/', [
    'uses' => 'EmployeeController@changeUsername',
    'as' => 'emp.chageUsername',
    ]);

  Route::post('profile', 'EmployeeController@update_photo');
