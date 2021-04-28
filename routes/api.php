<?php

use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function(){
    Route::get('/mahasiswa', [LoginController::class,'getMahasiswa']);
    Route::get('/kelas', [MahasiswaController::class,'kelas']);
});

Route::post('/login',[LoginController::class,'PostMahasiswa']);
