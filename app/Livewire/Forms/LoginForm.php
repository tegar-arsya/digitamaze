<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = ''; // Menyimpan alamat email pengguna

    #[Validate('required|string')]
    public string $password = ''; // Menyimpan kata sandi pengguna

    #[Validate('boolean')]
    public bool $remember = false; // Menyimpan status "ingat saya"

    /**
     * Mencoba untuk mengautentikasi kredensial yang diberikan.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited(); // Memastikan permintaan tidak dibatasi

        // Mencoba untuk mengautentikasi pengguna
        if (! Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            // Mencatat upaya gagal
            RateLimiter::hit($this->throttleKey());

            // Melempar pengecualian validasi jika autentikasi gagal
            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'), // Pesan kesalahan jika autentikasi gagal
            ]);
        }

        // Menghapus catatan upaya jika autentikasi berhasil
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Memastikan permintaan autentikasi tidak dibatasi.
     */
    protected function ensureIsNotRateLimited(): void
    {
        // Memeriksa apakah ada terlalu banyak upaya
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return; // Jika tidak, keluar dari metode
        }

        // Mengirimkan event Lockout jika terlalu banyak upaya
        event(new Lockout(request()));

        // Mendapatkan waktu yang tersisa sebelum dapat mencoba lagi
        $seconds = RateLimiter::availableIn($this->throttleKey());

        // Melempar pengecualian validasi dengan pesan throttle
        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds, // Detik yang tersisa
                'minutes' => ceil($seconds / 60), // Menit yang tersisa
            ]),
        ]);
    }

    /**
     * Mendapatkan kunci throttle untuk membatasi upaya autentikasi.
     */
    protected function throttleKey(): string
    {
        // Menghasilkan kunci throttle berdasarkan email dan alamat IP
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
