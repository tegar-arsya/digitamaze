<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Quick Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Kelas Card --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg transform transition duration-300 hover:scale-105">
                    <div class="p-6 flex items-center justify-between">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 dark:text-blue-300 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <a href="{{ route('kelas.index') }}" class="block bg-blue-50 dark:bg-gray-700 text-center py-2 text-blue-600 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-gray-600 transition">
                        Manage Kelas
                    </a>
                </div>

                {{-- Guru Card --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg transform transition duration-300 hover:scale-105">
                    <div class="p-6 flex items-center justify-between">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 dark:text-green-300 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <a href="{{ route('guru.index') }}" class="block bg-green-50 dark:bg-gray-700 text-center py-2 text-green-600 dark:text-green-300 hover:bg-green-100 dark:hover:bg-gray-600 transition">
                        Manage Guru
                    </a>
                </div>

                {{-- Siswa Card --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg transform transition duration-300 hover:scale-105">
                    <div class="p-6 flex items-center justify-between">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-500 dark:text-purple-300 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <a href="{{ route('siswa.index') }}" class="block bg-purple-50 dark:bg-gray-700 text-center py-2 text-purple-600 dark:text-purple-300 hover:bg-purple-100 dark:hover:bg-gray-600 transition">
                        Manage Siswa
                    </a>
                </div>
            </div>

            {{-- Welcome Message --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <p class="text-xl">{{ __("Selamat Datang di Sistem Manajemen Sekolah!") }}</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ __("You're logged in and ready to manage your school's data.") }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

