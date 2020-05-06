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


Route::resource('/employees', 'EmployeeController');

Route::resource('/departments', 'DepartmentController');

Route::get('/departments/{department}/managers', 'DepartmentController@managers');

Route::get('/departments/{department}/employees', 'DepartmentController@employees');

Route::resource('/titles', 'TitleController');
