<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use App\Models\Kelas;
use Livewire\Component;

class ManageSiswa extends Component
{
    // Variabel untuk menyimpan data siswa, nama siswa, email, ID siswa dan ID kelas
    public $siswas, $nama, $email, $kelas_id, $siswa_id;
    public $confirmingDelete = null; // Variabel untuk menyimpan ID siswa yang akan dihapus
    // Variabel baru untuk filter kelas
    public $filterKelas = ''; // Untuk menyimpan ID kelas yang dipilih untuk filter
    // Metode untuk merender komponen
    public function render()
    {
        // Query dasar untuk siswa dengan relasi kelas
        $query = Siswa::with('kelas');


        // Tambahkan filter kelas jika dipilih
        if ($this->filterKelas !== '') {
            $query->where('kelas_id', $this->filterKelas);
        }

        // Ambil data siswa sesuai filter
        $this->siswas = $query->get();
        // Kembalikan tampilan komponen dengan data kelas untuk dropdown filter dan pilihan kelas
        return view('livewire.siswa.manage-siswa', [
            'kelas' => Kelas::all(), // Semua kelas untuk dropdown
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
        // Mengatur nama, email, ID kelas, dan ID siswa menjadi null
        $this->nama = $this->email = $this->kelas_id = $this->siswa_id = null;
    }

    // Metode untuk menyimpan atau memperbarui data siswa
    public function store()
    {
        // Validasi input
        $this->validate([
            'nama' => 'required|min:3|max:255',
            'email' => 'required|email|unique:siswas,email,' . $this->siswa_id,
            'kelas_id' => 'required|exists:kelas,id'
        ]);
        // Mengupdate atau membuat data siswa baru berdasarkan ID
        Siswa::updateOrCreate(['id' => $this->siswa_id], [
            'nama' => $this->nama,
            'email' => $this->email,
            'kelas_id' => $this->kelas_id,
        ]);

        // Tambahkan flash message untuk konfirmasi
        session()->flash('message', $this->siswa_id ? 'Data siswa berhasil diupdate.' : 'Data siswa berhasil ditambahkan.');
        // Mereset input setelah penyimpanan
        $this->resetInput();
    }

    // Metode untuk mengedit data siswa
    public function edit($id)
    {
        // Mencari siswa berdasarkan ID
        $siswa = Siswa::find($id);
        if ($siswa) {
            // Mengisi variabel dengan data siswa untuk keperluan edit
            $this->siswa_id = $id;
            $this->nama = $siswa->nama;
            $this->email = $siswa->email;
            $this->kelas_id = $siswa->kelas_id;
        } else {
            // Menampilkan pesan error jika siswa tidak ditemukan
            session()->flash('error', 'Data siswa tidak ditemukan.');
        }
    }

    // Metode untuk mengonfirmasi penghapusan siswa
    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id; // Menyimpan ID siswa yang akan dihapus
    }

    // Metode untuk menghapus data siswa
    public function delete()
    {
        // Memastikan ada ID siswa yang dikonfirmasi untuk dihapus
        if ($this->confirmingDelete) {
            // Menghapus siswa berdasarkan ID yang dikonfirmasi
            Siswa::find($this->confirmingDelete)->delete();
            $this->confirmingDelete = null; // Mengatur kembali ID konfirmasi penghapusan
            // Menampilkan pesan sukses
            session()->flash('message', 'Data siswa berhasil dihapus.');
        }
    }
}
