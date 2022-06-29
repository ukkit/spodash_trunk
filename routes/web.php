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


Auth::routes();

Route::get('/', function () {
    return redirect('/instanceDetails');
});

Route::get('/home', function () {
    return redirect('/instanceDetails');
});

Route::group(['middleware' => 'auth'], function () {

    Route::resource('serverDetails', 'Server_detailController')->except(['index', 'show']);
    Route::resource('instanceDetails', 'Instance_detailController')->except(['index', 'show']);

    Route::post('instanceDetails/runjob/{id}/{action}', 'Instance_detailController@runjob')->name('instance.runjob');

    Route::resource('productNames', 'Product_nameController');
    Route::resource('osTypes', 'Os_typeController');
    Route::resource('databaseTypes', 'Database_typeController');
    Route::resource('productVersions', 'Product_versionController');
    Route::resource('serverUses', 'Server_useController');
    Route::resource('databaseDetails', 'Database_detailController');
    Route::resource('intellicusDetails', 'Intellicus_detailController');

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    Route::resource('sprintCalendars', 'Sprint_calendarController');
    Route::resource('actionHistories', 'Action_historyController');
    Route::get('/stats', 'Action_historyController@stats')->name('actionHistories.stats');

    Route::resource('intellicusDetails', 'Intellicus_detailController');
    Route::resource('intellicusVersions', 'Intellicus_versionController');

    Route::get('/changePassword', 'Auth\ChangePasswordController@showChangePasswordForm');
    Route::post('/changePassword', 'Auth\ChangePasswordController@changePassword')->name('changePassword');
    Route::resource('teams', 'TeamController');

    Route::resource('releaseMilestones', 'Release_milestoneController')->except(['index', 'show']);

    Route::resource('ambariDetails', 'Ambari_detailController');

    Route::resource('paiDetails', 'Pai_detailController');

    Route::resource('databaseSizes', 'Database_sizeController');

    Route::resource('systemStatistics', 'System_statisticController');
    Route::get('/detailedStats', 'System_statisticController@details')->name('systemStatistics.details');

    Route::resource('tablespaceDetails', 'Tablespace_detailController');

    Route::resource('dbaDetails', 'Dba_detailController');

    Route::resource('mlDetails', 'Ml_detailController');

    Route::resource('paiBuilds', 'Pai_buildController');

    Route::resource('sfBuilds', 'Sf_buildController');
});


Route::get('/logout', function () {
    Auth::logout();
    Session::flush();

    // return redirect('/instanceDetails');
    return redirect()->back();
})->name('user.logout');

//Routes accessible when logged out

// Route::get('/intellicusDetails', 'Intellicus_detailController@index')->name('intellicusDetails.index');

Route::get('/serverDetails', 'Server_detailController@index')->name('serverDetails.index');
Route::get('/serverDetails/{id}', 'Server_detailController@show')->name('serverDetails.show');

Route::get('/preSales', 'Instance_detailController@presales')->name('instanceDetails.presales');

Route::get('/instanceDetails', 'Instance_detailController@index')->name('instanceDetails.index');

Route::get('/instanceDetails/{id}', 'Instance_detailController@show')->name('instanceDetails.show');

// Route::get('/sprintCalendars', 'Sprint_calendarController@index')->name('sprintCalendars.index');

// Route::get('/releaseMilestones', 'Release_milestoneController@index')->name('releaseMilestones.index');
// Route::get('/releaseMilestones/{id}', 'Release_milestoneController@show')->name('releaseMilestones.show');

Route::get('/reset_password', 'Auth\ResetPasswordController@reset')->name('reset.password');

Route::get('/email', 'Instance_detailController@email')->name('send.mail');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('show.log');
