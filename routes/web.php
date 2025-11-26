<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
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
// DASHBOARD KHUSUS ROLE
// =========================

// Dashboard Admin
Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

// Dashboard User
Route::get('/user/dashboard', [AuthController::class, 'userDashboard'])
    ->middleware(['auth', 'role:user'])
    ->name('user.dashboard');
