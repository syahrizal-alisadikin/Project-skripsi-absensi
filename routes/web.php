<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dosen\DosenController;
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



Route::get('/',[LoginController::class,'AuthDosen'])->name('auth-dosen');
Route::get('/login',[LoginController::class,'AuthAdmin'])->name('auth-admin');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::post('/login-dosen',[LoginController::class,'PostDosen'])->name('postAuth-dosen');
Route::post('/login-admin',[LoginController::class,'PostAdmin'])->name('postAuth-admin');

Route::prefix('admin')->middleware('admin')
        ->group(function(){
            Route::resource('semester', SemesterController::class);
            Route::get('/',[DashboardController::class,'index'])->name('dashboard-admin');
        });

Route::prefix('dosen')->middleware('dosen')
        ->group(function(){
            Route::get('/',[DosenController::class,'index'])->name('dashboard-dosen');

        });
