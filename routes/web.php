<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//访问频率限制每分钟10次
Route::group(['middleware'=>'throttle:10'],function(){
    Auth::routes();
});
Route::resource('bet', 'BetController');

// Admin Interface Routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    //Route::get('dashboard', 'Admin\AdminController@index');

    // [...] other routes

    // Backpack\CRUD: Define the resources for the entities you want to CRUD.
    CRUD::resource('announcement', 'Admin\AnnouncementCrudController');
    CRUD::resource('team', 'Admin\TeamCrudController');
    CRUD::resource('user', 'Admin\UserCrudController');
});
