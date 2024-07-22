<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MediaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin','middleware' => 'check.auth'], function () {
    Route::get('', [AdminController::class, 'index']);

    //faq
    Route::get('media/stats/{id}', [MediaController::class, 'stats']);
    Route::get('media/groupaction/{status}', [MediaController::class, 'groupaction']);
    Route::get('media', [MediaController::class, 'index']);
    Route::post('/media', [MediaController::class, 'store'])->name('admin.media.store');
    Route::post('/media/update/{id}', [MediaController::class, 'update']);
    Route::get('/media/remove/{id}', [MediaController::class, 'destroy']);
    Route::post('/media/update_order', [MediaController::class, 'update_order']);
    Route::get('/media/edit/{id}', [MediaController::class, 'edit']);
    Route::get('media/{product}', [MediaController::class, 'show']);
    Route::get('media/add/new', [MediaController::class, 'create']);
    Route::get('media/moderate/{id}', [MediaController::class, 'moderate']);
    Route::get('media/changestatus/{status}/{id}', [MediaController::class, 'changestatus']);
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');

