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


//新建项目相关路由

Route::get('/', 'ProjectsController@index')->name('index');
Route::resource('projects','ProjectsController');
Route::resource('tasks','TasksController');
Route::post('tasks/{task}/check','TasksController@check')->name('tasks.check');
//Route::post('projects','ProjectsController@store')->name('projects.store');
//Route::delete('projects/{project}','ProjectsController@destroy')->name('projects.destroy');
//Route::post('projects/{project}','ProjectsController@update')->name('projects.update');
