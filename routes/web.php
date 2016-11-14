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

Auth::routes();

Route::get('/home', 'HomeController@index');

// Admin Interface Routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    //Route::get('dashboard', 'Admin\AdminController@index');

    // [...] other routes

    // Backpack\CRUD: Define the resources for the entities you want to CRUD.
    CRUD::resource('announcement', 'Admin\AnnouncementCrudController');
    CRUD::resource('team', 'Admin\TeamCrudController');
});
