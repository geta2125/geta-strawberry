<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MatakuliahController;


// ============================
// ROUTE PUBLIC (TANPA LOGIN)
// ============================
Route::get('/', fn() => view('welcome'));
Route::get('/pcr', fn() => 'Selamat Datang di Website Kampus PCR!');
Route::get('/mahasiswa', fn() => 'Halo Mahasiswa')->name('mahasiswa.show');
Route::get('/nama/{param1}', fn($param1) => 'Nama saya: ' . $param1);
Route::get('/nim/{param1?}', fn($param1 = '') => 'NIM saya: ' . $param1);
Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);
Route::get('/about', fn() => view('halaman-about'))->name('route.about');
Route::get('/matakuliah/{param1}', [MatakuliahController::class, 'show']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');


// ============================
// ROUTE LOGIN (PUBLIC)
// ============================
Route::get('auth', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');


// ============================
// ROUTE YANG HARUS LOGIN
// ============================
Route::middleware(['checkislogin'])->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Pelanggan (SEMUA ROLE BISA)
    Route::resource('pelanggan', PelangganController::class);

    // Upload Files Pelanggan
    Route::prefix('pelanggan')
        ->name('pelanggan.')
        ->controller(PelangganController::class)
        ->group(function () {
            Route::post('upload-files', 'uploadFiles')->name('upload-files');
            Route::delete('file/{fileId}', 'deleteFile')->name('delete-file');
        });

    // ============================
    // USER — KHUSUS SUPER ADMIN
    // ============================
    // Route::middleware(['checkrole:Super Admin'])->group(function () {
        Route::resource('user', UserController::class);
    });
// });
