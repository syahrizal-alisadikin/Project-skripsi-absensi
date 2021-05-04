<?php

use App\Http\Controllers\Admin\AbsenController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Dosen\DosController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PertemuanController;
use App\Http\Controllers\Dosen\MatkulDosenController;
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
            Route::resource('admin', AdminController::class);
            Route::resource('kelas', KelasController::class);
            Route::resource('dosen', DosenController::class);
            Route::resource('mahasiswa', MahasiswaController::class);
            Route::resource('pertemuan', PertemuanController::class);
            Route::resource('semester', SemesterController::class);
            Route::resource('jurusan', JurusanController::class);
            Route::resource('matkul', MatkulController::class);
            Route::resource('jadwal', JadwalController::class);
            Route::resource('absen', AbsenController::class);
            Route::get('print-pdf',[AbsenController::class,'print_pdf'])->name('print_pdf');
            Route::get('/absen/pertemuan/{id}',[AbsenController::class,'absenPertemuan'])->name('absen.pertemuan-show');
        });

Route::prefix('dosen')->middleware('dosen')
        ->group(function(){
            Route::get('/',[DosController::class,'index'])->name('dashboard-dosen');
            Route::get('/account',[DosController::class,'account'])->name('account');
            Route::get('/password',[DosController::class,'password'])->name('password');
            Route::PUT('/dosen-update/{id}',[DosController::class,'updateDosen'])->name('updateDosen');
            Route::PUT('/dosen-update-password/{id}',[DosController::class,'updatePasswordDosen'])->name('updatePasswordDosen');
            
            Route::get('/matakuliah' ,[MatkulDosenController::class,'index'])->name('matkulDosen.index');
            Route::get('/matakuliah/{id}' ,[MatkulDosenController::class,'MatkulPertemuan'])->name('matakuliah.pertemuan');
            Route::get('/generateAbsen/{id}' ,[MatkulDosenController::class,'generateAbsen'])->name('generateAbsen');
            Route::get('/AddAbsen/{id}' ,[MatkulDosenController::class,'AddTimeAbsen'])->name('AddTimeAbsen');
            Route::get('/generateView/{id}' ,[MatkulDosenController::class,'generateView'])->name('generateView');
        });
