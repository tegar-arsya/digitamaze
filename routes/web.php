<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Guru\ManageGuru;
use App\Livewire\Kelas\ManageKelas;
use App\Livewire\Siswa\ManageSiswa;

/*
|--------------------------------------------------------------------------
| Rute Web
|--------------------------------------------------------------------------
|
| Di sini adalah tempat Anda dapat mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web". Buatlah sesuatu yang hebat!
|
*/

// Rute untuk halaman beranda
Route::view('/', 'welcome');

// Rute untuk halaman dashboard dengan middleware autentikasi dan verifikasi
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute untuk halaman profil dengan middleware autentikasi
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Kelompok rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute untuk mengelola data guru
    Route::get('/guru', ManageGuru::class)->name('guru.index');

    // Rute untuk mengelola data kelas
    Route::get('/kelas', ManageKelas::class)->name('kelas.index');

    // Rute untuk mengelola data siswa
    Route::get('/siswa', ManageSiswa::class)->name('siswa.index');
});

// Memuat rute autentikasi
require __DIR__.'/auth.php';
