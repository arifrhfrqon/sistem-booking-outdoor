<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function(){
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('users', AdminController::class);
    Route::resource('denda', DendaController::class);
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/laporanbooking', [LaporanController::class, 'booking'])->name('laporan.booking');
    Route::get('/kerusakan', [LaporanController::class, 'kerusakan'])->name('laporan.kerusakan');
    Route::put('/booking/{id}/konfirmasi', [LaporanController::class, 'konfirmasi'])
        ->name('booking.konfirmasi');
    Route::put('/booking/{id}/kembalikan', [LaporanController::class, 'kembalikan'])
        ->name('booking.konfirmasiDenda');
    Route::get('/admin/live-search', [AdminController::class, 'liveSearch'])
    ->name('admin.liveSearch');
    Route::get('/laporan-sewa', [SewaController::class, 'index'])->name('sewa.index');
    Route::get('/laporan-sewa/create', [SewaController::class, 'create'])->name('sewa.create');
    Route::post('/laporan-sewa/store', [SewaController::class, 'store'])->name('sewa.store');
    Route::get('/laporan-sewa/edit/{id}', [SewaController::class, 'edit'])->name('sewa.edit');
    Route::put('/laporan-sewa/update/{id}', [SewaController::class, 'update'])->name('sewa.update');
    Route::get('/laporan-sewa/delete/{id}', [SewaController::class, 'destroy'])->name('sewa.delete');
    Route::get('/admin/laporan-sewa/get-booking/{id}', [SewaController::class, 'getBooking'])->name('sewa.getBooking');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/userdashboard', [UserDashboardController::class, 'index'])->name('user.index');
    Route::get('/barang/{id}', [UserDashboardController::class, 'show'])->name('barang.show');
    Route::get('/my-booking', [UserDashboardController::class, 'myBooking'])->name('user.myBooking');
    Route::resource('booking', BookingController::class);
    Route::get('/printAll', [BookingController::class, 'printAll'])->name('booking.printAll');
    Route::get('/booking/pdf/{id}', [BookingController::class, 'pdf'])
    ->name('booking.pdf');
    Route::get('/about', function () {
        return view('user.about');
    });
    Route::get('/baranguser', [UserDashboardController::class, 'index'])->name('user.barang.index');
    Route::get('/baranguser/{id}', [UserDashboardController::class, 'show'])->name('user.barang.show');
    Route::get('/baranguser/kategori/{namaKategori}', [UserDashboardController::class, 'kategori'])->name('user.barang.kategori');
});
