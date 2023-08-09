<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'login'])->name('login.index');
Route::post('login', [LoginController::class, 'handleLogin'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'can:role,"admin","pegawai"'], function () {
        Route::get('/admin', function () {
            return view('admin');
        })->name('admin');
    });

    Route::group(['middleware' => 'can:role,"pegawai"'], function () {
        Route::get('/pegawai', function () {
            return view('pegawai');
        })->name('pegawai');
    });
});

