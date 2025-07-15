<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZhahiraBeasiswasController;
use App\Http\Controllers\ZhahiraPendaftaransController;
use App\Http\Controllers\ZhahiraKategorisController;
use App\Http\Middleware\RoleAdmin;
use App\Http\Controllers\ZhahiraPengumumansController;

// Halaman utama (Homepage) – hanya untuk user yang sudah login
Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('homepage');

// Dashboard jika diperlukan (misalnya untuk admin)
Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

// Route otentikasi
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route CRUD Beasiswa – hanya bisa diakses jika sudah login
Route::middleware('auth')->group(function () {
    Route::get('/beasiswa', [ZhahiraBeasiswasController::class, 'index'])->name('beasiswa.index');
    Route::get('/beasiswa/create', [ZhahiraBeasiswasController::class, 'create'])->name('beasiswa.create');
    Route::post('/beasiswa', [ZhahiraBeasiswasController::class, 'store'])->name('beasiswa.store');
    Route::get('/beasiswa/{beasiswa}/edit', [ZhahiraBeasiswasController::class, 'edit'])->name('beasiswa.edit');
    Route::put('/beasiswa/{beasiswa}', [ZhahiraBeasiswasController::class, 'update'])->name('beasiswa.update');
    Route::delete('/beasiswa/{beasiswa}', [ZhahiraBeasiswasController::class, 'destroy'])->name('beasiswa.destroy');

    // Route form pendaftaran beasiswa
    Route::get('/pendaftaran/{beasiswa}/create', [ZhahiraPendaftaransController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [ZhahiraPendaftaransController::class, 'store'])->name('pendaftaran.store')->middleware('auth');
});

Route::resource('kategori', ZhahiraKategorisController::class)->middleware('auth');
Route::get('/pendaftaran/saya', [ZhahiraPendaftaransController::class, 'index'])->name('pendaftaran.index')->middleware('auth');

Route::middleware(['auth', RoleAdmin::class])->group(function () {
    Route::get('/admin/pendaftaran', [ZhahiraPendaftaransController::class, 'semua'])
        ->name('admin.pendaftaran.index');

    Route::patch('/admin/pendaftaran/{id}/status', [ZhahiraPendaftaransController::class, 'updateStatus'])
        ->name('admin.pendaftaran.updateStatus');
});

// Hanya izinkan route create dan store saja
Route::middleware(['auth'])->group(function () {
    Route::get('kategori/create', [ZhahiraKategorisController::class, 'create'])->name('kategori.create');
    Route::post('kategori', [ZhahiraKategorisController::class, 'store'])->name('kategori.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('pengumuman/create', [ZhahiraPengumumansController::class, 'create'])->name('pengumuman.create');
    Route::post('pengumuman', [ZhahiraPengumumansController::class, 'store'])->name('pengumuman.store');
});
Route::get('/pengumuman/{id}', [ZhahiraPengumumansController::class, 'show'])->name('admin.pengumuman.show');
