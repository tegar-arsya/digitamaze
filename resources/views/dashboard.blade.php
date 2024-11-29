<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Welcome Message --}}
            <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 text-white shadow-md rounded-lg">
                <div class="p-8 text-center">
                    <h3 class="text-3xl font-bold">{{ __("Selamat Datang!") }}</h3>
                    <p class="mt-2 text-lg">{{ __("Kelola data sekolah Anda dengan mudah dan efisien.") }}</p>
                </div>
            </div>

            {{-- Quick Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card Component --}}
                @php
                    $cards = [
                        ['title' => 'Manage Kelas', 'route' => 'kelas.index', 'color' => 'bg-blue-500', 'icon' => 'M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z'],
                        ['title' => 'Manage Guru', 'route' => 'guru.index', 'color' => 'bg-green-500', 'icon' => 'M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['title' => 'Manage Siswa', 'route' => 'siswa.index', 'color' => 'bg-purple-500', 'icon' => 'M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="shadow-lg rounded-lg overflow-hidden hover:scale-105 transform transition duration-300">
                        <div class="p-6 flex items-center {{ $card['color'] }} text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}" />
                            </svg>
                            <h4 class="ml-4 text-lg font-semibold">{{ $card['title'] }}</h4>
                        </div>
                        <a href="{{ route($card['route']) }}" class="block bg-gray-50 text-center py-2 text-gray-700 hover:bg-gray-100 transition">
                            Kelola Sekarang
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- List Sections --}}
            <div class="space-y-8">
                {{-- Template for List Sections --}}
                @php
                    $lists = [
                        ['title' => 'List Siswa Berdasarkan Kelas', 'component' => 'siswa.manage-siswa', 'props' => ['displayMode' => 'simple']],
                        ['title' => 'List Semua Siswa', 'component' => 'siswa.manage-siswa', 'props' => ['displayMode' => 'default']],
                        ['title' => 'List Guru Berdasarkan Kelas', 'component' => 'guru.manage-guru', 'props' => ['displayMode' => 'simple']],
                        ['title' => 'List Semua Guru', 'component' => 'guru.manage-guru', 'props' => ['displayMode' => 'default']],
                        ['title' => 'List Kelas', 'component' => 'kelas.manage-kelas', 'props' => ['displayMode' => 'simple']],
                    ];
                @endphp

                @foreach ($lists as $list)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200 mb-4">{{ $list['title'] }}</h3>
                        @livewire($list['component'], $list['props'])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
