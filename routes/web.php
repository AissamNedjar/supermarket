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

// Cache

Route::get('/aissamc', function() {
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    return '<h1>Ok !</h1>';
});

// Auth

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Dashboard

Route::get('/', 'DashboardController@home')->name('dashboard');
Route::post('/', 'DashboardController@home')->name('dashboard');

Route::get('/ticket/{id}', 'DashboardController@ticket')->name('ticket');
Route::post('/ticket/{id}', 'DashboardController@ticket')->name('ticket');

Route::post('/addbuy/{id}', 'DashboardController@addbuy')->name('addbuy');

Route::post('/icondelete/{id}', 'DashboardController@icondelete')->name('icondelete');
Route::post('/iconplus/{id}', 'DashboardController@iconplus')->name('iconplus');
Route::post('/iconminus/{id}', 'DashboardController@iconminus')->name('iconminus');

Route::post('/print/{id}', 'DashboardController@print')->name('print');

Route::get('/items/list', 'DashboardController@items')->name('items');
Route::post('/items/list', 'DashboardController@items')->name('items');

Route::get('/tickets/list', 'DashboardController@tickets')->name('tickets');
Route::post('/tickets/list', 'DashboardController@tickets')->name('tickets');

Route::get('/items/addedit/{id}', 'DashboardController@addEditItem')->name('addedititem');
Route::post('/items/addedit/{id}', 'DashboardController@addEditItem')->name('addedititem');

Route::get('/items/store/{id}', 'DashboardController@storeItem')->name('storeitem');
Route::post('/items/store/{id}', 'DashboardController@storeItem')->name('storeitem');