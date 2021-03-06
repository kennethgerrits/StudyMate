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

Route::prefix('dashboard')->group(function(){
    Route::get('/', 'DashboardController@index')->name('getDashboardIndex');
    Route::get('/{block}', 'DashboardController@details')->name('getDashboardDetails');
});


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']])->middleware('can:manage-users');
    Route::resource('/modules', 'ModulesController', ['except' => ['show']])->middleware('can:manage-modules');
    Route::resource('/exams', 'ExamController', ['except' => ['create', 'edit', 'update']])->middleware('can:manage-modules');
    Route::get('/destroyappendix/{exam}', 'ExamController@destroyAppendix')->name('getDestroyAppendix')->middleware('can:manage-modules');
    Route::get('/download/{exam}', 'ExamController@downloadZipfile')->name('getAppendix')->middleware('can:manage-modules');
});

Route::get('/deadlines/{column?}/{order?}/{table?}', 'DeadlineController@index')->name('getDeadlineManagerIndex')->middleware('can:manage-deadlines');
Route::post('/deadlines/post', 'DeadlineController@saveChanges')->name('postDeadlineManagerChanges')->middleware('can:manage-deadlines');

