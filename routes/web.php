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

use App\Library\Helpers\Constants\CapabilitiesNames;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/subject')->middleware('auth')->group(function () {
    Route::name('subject.')->group(function () {
        Route::get('/list', 'SubjectController@index')->name('list');
        Route::match(array('GET', 'POST'), '/edit/{subject?}', 'SubjectController@edit')->name('edit');

        Route::prefix('/{subjectName}/lesson')->group(function () {
            Route::name('lesson.')->group(function () {
                Route::get('/list', 'LessonController@index')->name('list');
                Route::match(array('GET', 'POST'), '/edit/{lesson?}', 'LessonController@edit')->name('edit');
            });
        });
    });
});
Route::prefix('/capabilities')->name('capabilities.')->group(function () {
    Route::get('/index', 'CapabilitiesController@index')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_VIEW_CAPABILITIES)
        ->name('index');
    Route::get('/{capability}/show', 'CapabilitiesController@show')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_VIEW_CAPABILITIES)
        ->name('show');
    Route::get('/create', 'CapabilitiesController@create')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_ADD_CAPABILITIES)
        ->name('create');
    Route::post('/store', 'CapabilitiesController@store')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_ADD_CAPABILITIES)
        ->name('store');
    Route::get('/{capability}/edit', 'CapabilitiesController@edit')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_EDIT_CAPABILITIES)
        ->name('edit');
    Route::put('/{capability}/update', 'CapabilitiesController@update')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_EDIT_CAPABILITIES)
        ->name('update');
    Route::get('/{capability}/delete', 'CapabilitiesController@delete')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_DELETE_CAPABILITIES)
        ->name('delete');
});

Route::prefix('/roles')->name('roles.')->group(function () {
    Route::get('/index', 'RolesController@index')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES)
        ->name('index');
    Route::get('/{role}/show', 'RolesController@show')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES)
        ->name('show');
    Route::get('/create', 'RolesController@create')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_ADD_ROLES)
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_VIEW_CAPABILITIES)
        ->name('create');
    Route::post('/store', 'RolesController@store')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_ADD_ROLES)
        ->name('store');
    Route::get('/{role}/edit', 'RolesController@edit')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_EDIT_ROLES)
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_VIEW_CAPABILITIES)
        ->name('edit');
    Route::put('/{role}/update', 'RolesController@update')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_EDIT_ROLES)
        ->name('update');
});

Route::prefix('/users')->name('users.')->group(function () {
    Route::get('/index', 'UsersController@index')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_VIEW_USERS)
        ->name('index');
    Route::get('/create', 'UsersController@create')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_ADD_USERS)
        ->name('create');
    Route::post('/store', 'UsersController@store')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_ADD_USERS)
        ->name('store');
    Route::get('/{user}/edit', 'UsersController@edit')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_EDIT_USERS)
        ->name('edit');
    Route::put('/{user}/update', 'UsersController@update')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_EDIT_USERS)
        ->name('update');
    Route::get('/{user}/change-status', 'UsersController@changeStatus')
        ->middleware('can:' . CapabilitiesNames::CAPABILITY_NAME_CHANGE_USERS_STATUSES)
        ->name('changeStatus');
});
/*Route::middleware('auth')->group(function () {
});*/
