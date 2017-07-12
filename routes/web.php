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

Route::get('/home', 'HomeController@index');

Route::get('/profile', 'EmployeeController@showProfile');
Route::get('jquery-loadmore',['as'=>'jquery-loadmore','uses'=>'EmployeeController@showProfile']);

Route::get('/changepw', 'EmployeeController@showChangePw');
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

  Route::post('profile', 'EmployeeController@update_photo');
