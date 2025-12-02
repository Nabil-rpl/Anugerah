<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PengunjungController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\JenisLayananController;
use App\Http\Controllers\Admin\SubLayananController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\LogoClientController;
use App\Http\Controllers\Admin\LayananClientController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\KategoriAlatController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\HamaController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\KotaController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController; // ← TAMBAHKAN INI
use Illuminate\Support\Facades\Auth;


// =========================
// AUTH ROUTES
// =========================

// Login Page
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


// =========================
// DASHBOARD
// =========================

// Dashboard umum (harus login)
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');


// =========================
// ADMIN ROUTES
// =========================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
    
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Pengunjung Management
    Route::resource('pengunjung', PengunjungController::class);
    Route::post('/pengunjung/{id}/toggle-status', [PengunjungController::class, 'toggleStatus'])->name('pengunjung.toggle-status');
    
    // Berita Management
    Route::resource('berita', BeritaController::class);
    
    // Jenis Layanan Management (Master Data)
    Route::get('/jenis-layanan', [JenisLayananController::class, 'index'])->name('jenis-layanan.index');
    Route::post('/jenis-layanan', [JenisLayananController::class, 'store'])->name('jenis-layanan.store');
    Route::put('/jenis-layanan/{id}', [JenisLayananController::class, 'update'])->name('jenis-layanan.update');
    Route::delete('/jenis-layanan/{id}', [JenisLayananController::class, 'destroy'])->name('jenis-layanan.destroy');

    // Sub Layanan Management (Master Data)
    Route::get('/sublayanan', [SubLayananController::class, 'index'])->name('sublayanan.index');
    Route::post('/sublayanan', [SubLayananController::class, 'store'])->name('sublayanan.store');
    Route::put('/sublayanan/{id}', [SubLayananController::class, 'update'])->name('sublayanan.update');
    Route::delete('/sublayanan/{id}', [SubLayananController::class, 'destroy'])->name('sublayanan.destroy');
     
    // Provinsi Management
    Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
    Route::post('/provinsi', [ProvinsiController::class, 'store'])->name('provinsi.store');
    Route::put('/provinsi/{kode}', [ProvinsiController::class, 'update'])->name('provinsi.update');
    Route::delete('/provinsi/{kode}', [ProvinsiController::class, 'destroy'])->name('provinsi.destroy');
    
    // Kota Management
    Route::resource('kota', KotaController::class);
    
    // Kecamatan Management
    Route::resource('kecamatan', KecamatanController::class);
    
    // Kelurahan Management ← TAMBAHKAN INI
    Route::resource('kelurahan', KelurahanController::class);
    
    // Slider Management
    Route::resource('slider', SliderController::class);
    
    // Logo Client Management
    Route::resource('logo-client', LogoClientController::class);
    
    // Layanan Client Management
    Route::resource('layanan-client', LayananClientController::class);
    
    // Master Client Management
    Route::resource('client', ClientController::class);
    
    // Kategori Alat Management (Master Data)
    Route::resource('kategori-alat', KategoriAlatController::class);

    // Alat Management
    Route::resource('alat', AlatController::class);
    
    // Satuan Management (Master Data)
    Route::resource('satuan', SatuanController::class);

    // Hama Management
    Route::resource('hama', HamaController::class);
    
});


// =========================
// USER ROUTES
// =========================

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', [AuthController::class, 'userDashboard'])->name('dashboard');
    
});