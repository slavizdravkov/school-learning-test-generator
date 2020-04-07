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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/subject')->group(function () {
    Route::name('subject.')->group(function () {
        Route::get('/list', 'SubjectController@index')->name('list');
        Route::match(array('GET', 'POST'), '/edit/{subject?}', 'SubjectController@edit')->name('edit');

        Route::prefix('/{subjectId}')->group(function () {
            Route::name('lesson.')->group(function () {
                Route::get('/list', 'LessonController@index')->name('list');
                Route::match(array('GET', 'POST'), '/edit/{lesson?}', 'LessonController@edit')->name('edit');
            });
        });
    });
});
