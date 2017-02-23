<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
	//return view('frontend.home');
	return view('users.login');
	});
Route::get('frontend', function () {
	return view('frontend.home');
	});
Route::get('user/login', 'UserController@login');
Route::post('user/login', 'UserController@loginCheck');
Route::get('user/logout', 'UserController@logout');
Route::get('user/signup', function () { return view('users.signup'); });
Route::post('user/signup', 'UserController@signup');
Route::get('/nhs-git', function () { return view('dashboards.nhs-content-dashboard'); });
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
	Route::get('/', function() { return view("dashboards.home"); });

	Route::controller('test', 'Testcontroller');


    Route::controller('csv-management', 'CsvImportController');
    Route::controller('about', 'AboutController');
    Route::controller('contact-us', 'ContactusController');
    Route::controller('privacy', 'PrivacyController');
    Route::controller('data-definitions', 'DefinitionsController');
    Route::controller('data-wizard', 'DatawizardController');
    Route::controller('mapping', 'MappingController');
    Route::controller('grouping', 'GroupingController');
    Route::controller('common', 'CommonController');
    Route::controller('data-item', 'DataitemController');


});




Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    
    Route::get('/', function() { return view("admin.home"); });
    Route::controller('reference-data', 'CsvManagementcontroller');
    Route::get('groups', 'GroupController@index');
	Route::post('group/delete-all', 'GroupController@delete_all');
	Route::resource('group', 'GroupController');

	Route::post('user/delete-all', 'UserController@delete_all');
	Route::get('users', 'UserController@index');
    Route::post('users/active-user', 'UserController@activation');
    Route::post('users/make-admin', 'UserController@makeadmin');
	Route::resource('user', 'UserController');



});

/*Password reset*/
Route::get('password-reset/{id}/{token}', ['as' => 'reminders.edit', 'uses' => 'ReminderController@edit']);
Route::post('password-reset/{id}/{token}', ['as' => 'reminders.update', 'uses' => 'ReminderController@update']);
Route::get('forgot-password', 'ReminderController@create');
Route::post('forgot-password', 'ReminderController@store');
/*Password reset ends*/