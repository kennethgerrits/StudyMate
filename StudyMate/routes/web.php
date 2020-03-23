<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix('dashboard')->group(function(){
    Route::get('/', 'DashboardController@index')->name('getDashboardIndex');
    Route::get('/{block}', 'DashboardController@details')->name('getDashboardDetails');
});


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']])->middleware('can:manage-users');
    Route::resource('/modules', 'ModulesController', ['except' => ['show']])->middleware('can:manage-modules');
    Route::resource('/exams', 'ExamController', ['except' => ['create', 'edit', 'update']]);
    Route::get('/destroyappendix/{exam}', 'ExamController@destroyAppendix')->name('getDestroyAppendix');
    Route::get('/download/{exam}', 'ExamController@downloadZipfile')->name('getAppendix');

});
