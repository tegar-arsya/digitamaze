{{--
    Komponen Manajemen Guru

    Deskripsi:
    Komponen ini menyediakan antarmuka untuk mengelola data guru dengan fitur:
    - Menambah data guru baru
    - Menampilkan daftar guru
    - Menyaring guru berdasarkan kelas
    - Mengedit data guru
    - Menghapus data guru

    Fitur Utama:
    1. Formulir Tambah guru
       - Input nama guru (wajib)
       - Input email guru (wajib)
       - Dropdown pilih kelas (wajib)
       - Validasi input
       - Tombol simpan

    2. Filter dan Tampilan Daftar guru
       - Dropdown filter kelas
       - Tombol reset filter
       - Menampilkan total jumlah guru
       - Tabel dengan kolom: Nama, Email, Kelas
       - Tombol aksi Edit dan Hapus untuk setiap guru

    3. Konfirmasi Penghapusan
       - Modal konfirmasi sebelum menghapus data guru
       - Opsi Ya (hapus) dan Batal
--}}
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Form untuk menambah data guru -->
        @if ($displayMode === 'full')
        <div class="p-6 bg-gray-50 border-b border-gray-200">
            <form wire:submit.prevent="store" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Input untuk Nama Guru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Guru</label>
                        <input
                            type="text"
                            wire:model="nama"
                            placeholder="Masukkan Nama Guru"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Input untuk Email Guru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Guru</label>
                        <input
                            type="email"
                            wire:model="email"
                            placeholder="Masukkan Email Guru"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Dropdown untuk memilih kelas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas</label>
                        <select
                            wire:model="kelas_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2.5 rounded-md hover:bg-blue-700 transition duration-300 font-semibold"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        @endif
        <!-- Filter Section -->
        <div class="p-4 bg-gray-100 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                @if ($displayMode === 'full' || $displayMode === 'simple')
                <label class="text-sm font-medium text-gray-700">Filter Kelas:</label>
                <select wire:model.live="filterKelas"
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>

                @if ($filterKelas !== '')
                    <button wire:click="resetFilter"
                        class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300">
                        Reset Filter
                    </button>
                @endif
                @endif
            </div>
            <div class="text-sm text-gray-600">
                Total Guru: {{ $gurus->count() }}
            </div>
        </div>
        <!-- Table untuk menampilkan data guru -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase">
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Kelas</th>
                        @if ($displayMode === 'full')
                        <th class="px-6 py-3 text-right font-semibold tracking-wider">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($gurus as $guru)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $guru->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $guru->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $guru->kelas->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @if ($displayMode === 'full')
                                <!-- Tombol Edit dan Hapus -->
                                <div class="flex justify-end space-x-2">
                                    <button
                                        wire:click="edit({{ $guru->id }})"
                                        class="px-4 py-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-300 text-sm"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        wire:click="confirmDelete({{ $guru->id }})"
                                        class="px-4 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-300 text-sm">
                                        Hapus
                                    </button>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                         <!-- Jika tidak ada data guru -->
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                Tidak ada data guru
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
        <!-- Konfirmasi Penghapusan -->
    @if ($confirmingDelete)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="flex justify-center mt-4 space-x-4">
                <button wire:click="delete"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                    Ya, Hapus
                </button>
                <button wire:click="$set('confirmingDelete', null)"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                    Batal
                </button>
            </div>
        </div>
    </div>
@endif
</div>
