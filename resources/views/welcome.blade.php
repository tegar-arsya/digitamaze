<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>School Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 font-sans">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="12" y1="18" x2="12" y2="12"></line>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                        <h1 class="text-2xl font-bold text-gray-800">Managemen Sekolah</h1>
                    </div>
                    <nav>
                        <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                            Login
                        </a>
                        <a href="/register" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300">
                            Register
                        </a>
                    </nav>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <!-- Left Column - Hero Content -->
                    <div>
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                            Simplify School Management
                        </h2>
                        <p class="text-xl text-gray-600 mb-8">
                            Solusi komprehensif untuk mengelola siswa, guru, kelas, dan tugas administratif dengan mudah dan efisien.
                        </p>

                        <!-- Feature Highlights -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                <span class="text-gray-700">Manajemen Siswa</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="text-gray-700">Manajemen Guru</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span class="text-gray-700">Manajemen Kelas</span>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300 shadow-md">
                                Get Started
                            </a>
                            <a href="#" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-md hover:bg-gray-300 transition duration-300 shadow-md">
                                Learn More
                            </a>
                        </div>
                    </div>

                    <!-- Right Column - Illustration -->
                    <div class="hidden md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" class="w-full h-auto">
                            <rect width="100%" height="100%" fill="#f0f9ff"/>
                            <circle cx="400" cy="300" r="200" fill="#e6f2ff"/>

                            <!-- School Building -->
                            <rect x="250" y="200" width="300" height="250" fill="#ffffff" stroke="#3b82f6" stroke-width="4" rx="10"/>

                            <!-- Windows -->
                            <rect x="300" y="250" width="80" height="60" fill="#bae6fd" stroke="#3b82f6" stroke-width="2"/>
                            <rect x="420" y="250" width="80" height="60" fill="#bae6fd" stroke="#3b82f6" stroke-width="2"/>

                            <!-- Door -->
                            <rect x="380" y="370" width="40" height="80" fill="#94a3b8" stroke="#3b82f6" stroke-width="2"/>

                            <!-- People -->
                            <circle cx="330" cy="450" r="20" fill="#60a5fa"/>
                            <circle cx="470" cy="450" r="20" fill="#60a5fa"/>
                            <circle cx="400" cy="420" r="25" fill="#3b82f6"/>
                        </svg>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white shadow-md py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <p class="text-gray-500">&copy; 2024 Sistem Manajemen Sekolah</p>
                </div>
            </footer>
        </div>
    </body>
</html>
