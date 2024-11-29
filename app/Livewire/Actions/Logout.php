<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     *
     * Metode ini digunakan untuk mengeluarkan pengguna yang sedang aktif dari aplikasi.
     */
    public function __invoke(): void
    {
        // Mengeluarkan pengguna dari guard 'web'
        Auth::guard('web')->logout();

        // Menghentikan sesi pengguna
        Session::invalidate();
        // Menghasilkan ulang token sesi untuk keamanan
        Session::regenerateToken();
    }
}
