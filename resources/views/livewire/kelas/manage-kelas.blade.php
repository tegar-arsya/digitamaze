<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        @if ($displayMode === 'full')
        <!-- Form untuk menambah data kelas -->
        <div class="p-6 bg-gray-50 border-b border-gray-200">
            <form wire:submit.prevent="store" class="flex space-x-4">
                <div class="flex-grow">
                    <!-- Input untuk Nama Kelas -->
                    <input
                        type="text"
                        wire:model="nama"
                        placeholder="Masukkan Nama Kelas"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300"
                        required
                    />
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1 pl-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Tombol Simpan -->
                <button
                    type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Simpan
                </button>
            </form>
        </div>
        @endif
        <!-- Table untuk menampilkan data kelas -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase">
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Nama Kelas</th>
                        @if ($displayMode === 'full')
                        <th class="px-6 py-3 text-right font-semibold tracking-wider">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($kelases as $kelas)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $kelas->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @if ($displayMode === 'full')
                                <!-- Tombol Edit dan Hapus -->
                                <div class="flex justify-end space-x-2">
                                    <button
                                        wire:click="edit({{ $kelas->id }})"
                                        class="px-4 py-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-300 text-sm">
                                        Edit
                                    </button>
                                    <button
                                        wire:click="confirmDelete({{ $kelas->id }})"
                                        class="px-4 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-300 text-sm">
                                        Hapus
                                    </button>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <!-- Jika tidak ada data kelas -->
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-500">
                                Tidak ada data kelas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal untuk Edit Data Kelas dan konfirmasi action -->
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
