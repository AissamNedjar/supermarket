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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/aissamc', function() {
	$exitCode = Artisan::call('config:cache');
	$exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    return '<h1>Ok !</h1>';
});

// Auth

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'home'])->name('dashboard');
Route::post('/', [DashboardController::class, 'home'])->name('dashboard');

Route::get('/ticket/{id}', [DashboardController::class, 'ticket'])->name('ticket');
Route::post('/ticket/{id}', [DashboardController::class, 'ticket'])->name('ticket');

Route::post('/addbuy/{id}', [DashboardController::class, 'addbuy'])->name('addbuy');

Route::post('/icondelete/{id}', [DashboardController::class, 'icondelete'])->name('icondelete');
Route::post('/iconplus/{id}', [DashboardController::class, 'iconplus'])->name('iconplus');
Route::post('/iconminus/{id}', [DashboardController::class, 'iconminus'])->name('iconminus');

Route::post('/print/{id}', [DashboardController::class, 'print'])->name('print');

Route::get('/items/list', [DashboardController::class, 'items'])->name('items');
Route::post('/items/list', [DashboardController::class, 'items'])->name('items');

Route::get('/tickets/list', [DashboardController::class, 'tickets'])->name('tickets');
Route::post('/tickets/list', [DashboardController::class, 'tickets'])->name('tickets');

Route::get('/items/addedit/{id}', [DashboardController::class, 'addEditItem'])->name('addedititem');
Route::post('/items/addedit/{id}', [DashboardController::class, 'addEditItem'])->name('addedititem');

Route::get('/items/store/{id}', [DashboardController::class, 'storeItem'])->name('storeitem');
Route::post('/items/store/{id}', [DashboardController::class, 'storeItem'])->name('storeitem');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
