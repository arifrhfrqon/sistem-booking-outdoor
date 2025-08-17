<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('users', AdminController::class);
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/userdashboard', [UserDashboardController::class, 'index'])->name('user.index');
});
