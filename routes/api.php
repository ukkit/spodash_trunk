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

Route::post('login', 'UserAPIController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'UserAPIController@details');

    Route::resource('database_types', 'Database_typeAPIController');
    Route::resource('databaseTypes', 'Database_typeAPIController');

    Route::resource('os_types', 'Os_typeAPIController');
    Route::resource('osTypes', 'Os_typeAPIController');

    Route::resource('product_versions', 'Product_versionAPIController');
    Route::resource('productVersions', 'Product_versionAPIController');

    Route::resource('database_details', 'Database_detailAPIController');
    Route::resource('databaseDetails', 'Database_detailAPIController');

    Route::resource('server_details', 'Server_detailAPIController');
    Route::resource('serverDetails', 'Server_detailAPIController');

    Route::resource('instance_details', 'Instance_detailAPIController');
    Route::resource('instanceDetails', 'Instance_detailAPIController');
});
