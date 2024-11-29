<?php

namespace App\Livewire\Kelas;

use App\Models\Kelas;
use Livewire\Component;

class ManageKelas extends Component
{
    public $kelases, $nama, $kelas_id; // Variabel untuk menyimpan data kelas, nama kelas, dan ID kelas
    public $confirmingDelete = null; // Variabel untuk menyimpan ID kelas yang akan dihapus

    // Metode untuk merender komponen
    public function render()
    {
        // Mengambil semua data kelas dari model Kelas
        $this->kelases = Kelas::all();
        // Mengembalikan tampilan komponen manage-kelas
        return view('livewire.kelas.manage-kelas');
    }

    // Metode untuk mereset input form
    public function resetInput()
    {
        $this->nama = $this->kelas_id = null; // Mengatur nama dan ID kelas menjadi null
    }

    // Metode untuk menyimpan atau memperbarui data kelas
    public function store()
    {
        // Mengupdate atau membuat data kelas baru berdasarkan ID
        Kelas::updateOrCreate(['id' => $this->kelas_id], [
            'nama' => $this->nama,
        ]);

        // Mereset input setelah penyimpanan
        $this->resetInput();
    }

    // Metode untuk mengedit data kelas
    public function edit($id)
    {
        // Mencari kelas berdasarkan ID
        $kelas = Kelas::find($id);
        // Mengatur ID kelas dan nama kelas untuk form edit
        $this->kelas_id = $id;
        $this->nama = $kelas->nama;
    }

    // Metode untuk mengonfirmasi penghapusan
    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id; // Menyimpan ID kelas yang akan dihapus
    }

    // Metode untuk menghapus data kelas
    public function delete()
    {
        // Memastikan ada ID kelas yang dikonfirmasi untuk dihapus
        if ($this->confirmingDelete) {
            Kelas::find($this->confirmingDelete)->delete(); // Menghapus kelas berdasarkan ID
            $this->confirmingDelete = null; // Mengatur kembali ID konfirmasi penghapusan
            session()->flash('message', 'Data kelas berhasil dihapus.'); // Menampilkan pesan sukses
        }
    }
}
