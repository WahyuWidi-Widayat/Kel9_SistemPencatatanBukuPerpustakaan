<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 md:p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-600 dark:text-gray-400">Pilih menu di bawah untuk mulai mengelola konten.</p>
                </div>

                {{-- Grid diubah untuk menampung 3 item dengan lebih baik --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- KARTU MANAJEMEN BUKU --}}
                    <a href="{{ route('admin.books.index') }}" class="block group">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6 flex items-start gap-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                            <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-blue-600">Manajemen Buku</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Tambah, edit, atau hapus buku dari koleksi perpustakaan.</p>
                            </div>
                        </div>
                    </a>

                    {{-- KARTU MANAJEMEN PENGGUNA --}}
                    <a href="{{ route('admin.users.index') }}" class="block group">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6 flex items-start gap-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                             <div class="flex-shrink-0 bg-green-100 dark:bg-green-900 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.68c.119-.242.24-.483.37-1.128m2.115-2.115A12.298 12.298 0 0015 12c-1.348 0-2.626.21-3.824.593m12.342 0a12.342 12.342 0 00-12.342 0" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-green-600">Manajemen Pengguna</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Lihat dan kelola pengguna yang terdaftar di dalam sistem.</p>
                            </div>
                        </div>
                    </a>

                    {{-- === KARTU BARU: MANAJEMEN PEMINJAMAN === --}}
                    <a href="{{ route('admin.borrowings.index') }}" class="block group">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6 flex items-start gap-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                            <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m-4.5-15v15m9-15v15" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-yellow-600">Manajemen Peminjaman</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola semua data peminjaman buku oleh pengguna.</p>
                            </div>
                        </div>
                    </a>
                    {{-- === AKHIR DARI KARTU BARU === --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>