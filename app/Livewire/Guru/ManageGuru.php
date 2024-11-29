<?php

namespace App\Livewire\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use Livewire\Component;

class ManageGuru extends Component
{
    // Variabel untuk menyimpan data guru, nama guru, email, ID kelas, dan ID guru
    public $gurus, $nama, $email, $kelas_id, $guru_id;
    public $confirmingDelete = null; // Variabel untuk menyimpan ID guru yang akan dihapus
    public $filterKelas = ''; // Untuk menyimpan ID kelas yang dipilih untuk filter
    // Metode untuk merender komponen
    public function render()
    {
        // Query dasar untuk siswa dengan relasi kelas
        $query = Guru::with('kelas');

        // Jika filter kelas dipilih, maka menambahkan filter ke query
        if ($this->filterKelas !== '') {
            $query->where('kelas_id', $this->filterKelas);
        }

        // Mengambil semua data guru yang sudah disesuaikan dengan query
        $this->gurus = $query->get();

        // Kembalikan tampilan komponen dengan data kelas untuk dropdown filter dan pilihan kelas
        return view('livewire.guru.manage-guru', [
            'kelas' => Kelas::all(), // Mengambil semua data kelas untuk ditampilkan
            'filterKelas' => $this->filterKelas // Untuk mempertahankan pilihan filter
        ]);
    }

    // Metode untuk mereset filter kelas
    public function resetFilter()
    {
        $this->filterKelas = ''; // Mereset filter ke kondisi awal (semua kelas)
    }
    // Metode untuk mereset input form
    public function resetInput()
    {
        // Mengatur nama, email, ID kelas, dan ID guru menjadi null
        $this->nama = $this->email = $this->kelas_id = $this->guru_id = null;
    }

    // Metode untuk menyimpan atau memperbarui data guru
    public function store()
    {
        // Validasi input
        $this->validate([
            'nama' => 'required|min:3|max:255',
            'email' => 'required|email|unique:gurus,email,' . $this->guru_id,
            'kelas_id' => 'required|exists:kelas,id'
        ]);
        // Mengupdate atau membuat data guru baru berdasarkan ID
        Guru::updateOrCreate(['id' => $this->guru_id], [
            'nama' => $this->nama,
            'email' => $this->email,
            'kelas_id' => $this->kelas_id,
        ]);

          // Tambahkan flash message untuk konfirmasi
          session()->flash('message', $this->guru_id ? 'Data Guru berhasil diupdate.' : 'Data GURU berhasil ditambahkan.');

        // Mereset input setelah penyimpanan
        $this->resetInput();
    }

    // Metode untuk mengedit data guru
    public function edit($id)
    {
        // Mencari guru berdasarkan ID
        $guru = Guru::find($id);
        // Mengisi variabel dengan data guru untuk keperluan edit
        $this->guru_id = $id;
        $this->nama = $guru->nama;
        $this->email = $guru->email;
        $this->kelas_id = $guru->kelas_id;
    }

    // Metode untuk mengonfirmasi penghapusan guru
    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id; // Menyimpan ID guru yang akan dihapus
    }

    // Metode untuk menghapus data guru
    public function delete()
    {
        // Memastikan ada ID guru yang dikonfirmasi untuk dihapus
        if ($this->confirmingDelete) {
            // Menghapus guru berdasarkan ID yang dikonfirmasi
            Guru::find($this->confirmingDelete)->delete();
            $this->confirmingDelete = null; // Mengatur kembali ID konfirmasi penghapusan
            // Menampilkan pesan sukses
            session()->flash('message', 'Data guru berhasil dihapus.');
        }
    }
}
