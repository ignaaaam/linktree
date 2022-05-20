<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\LinkController;

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
    return view('home');
});

Auth::routes();

//laravel-links.com/dashboard/links
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function() {
    Route::get('links', [LinkController::class, 'index']);
    Route::get('links/new', [LinkController::class, 'create']);
    Route::post('links/new', [LinkController::class, 'store']);
    Route::get('links/{link}', [LinkController::class, 'edit']);
    Route::post('links/{link}', [LinkController::class, 'update']);
    Route::delete('links/{link}', [LinkController::class, 'destroy']);

    Route::get('/settings', [UserController::class, 'edit']);
    Route::post('/settings', [UserController::class, 'update']);
});

Route::post('/visit/{link}', [VisitController::class, 'store']);

// laravel-links.com/username
Route::get('/{user}', [UserController::class, 'show']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
