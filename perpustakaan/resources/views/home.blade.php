<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Koleksi Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    {{-- === FORM PENCARIAN === --}}
                    <form action="{{ route('home') }}" method="GET" class="mb-4">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Cari buku berdasarkan judul atau penulis..." class="w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ request('search') }}">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Cari</button>
                        </div>
                    </form>
                    
                    {{-- === FORM SORTING (BARU) === --}}
                    <form action="{{ route('home') }}" method="GET" class="mb-8">
                        {{-- Simpan parameter search jika ada --}}
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        
                        <select name="sort" onchange="this.form.submit()" class="w-full md:w-1/3 border-gray-300 rounded-md shadow-sm">
                            <option value="latest" @selected(request('sort') == 'latest')>Urutkan: Terbaru</option>
                            <option value="title_asc" @selected(request('sort') == 'title_asc')>Urutkan: Judul (A-Z)</option>
                            <option value="title_desc" @selected(request('sort') == 'title_desc')>Urutkan: Judul (Z-A)</option>
                            <option value="author_asc" @selected(request('sort') == 'author_asc')>Urutkan: Penulis (A-Z)</option>
                            <option value="author_desc" @selected(request('sort') == 'author_desc')>Urutkan: Penulis (Z-A)</option>
                        </select>
                    </form>
                    {{-- === AKHIR DARI FORM SORTING === --}}

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($books as $book)
                            <div class="flex flex-col bg-gray-100 rounded-lg shadow-md overflow-hidden">
                                <a href="{{ route('book.show', $book) }}">
                                    <div class="h-48 bg-gray-200">
                                        @if ($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                                <span>Tanpa Cover</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4 flex flex-col flex-grow">
                                        {{-- Anda bisa tambahkan badge status di sini jika mau --}}
                                        <h3 class="font-bold text-lg truncate">{{ $book->title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $book->author }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Tidak ada buku yang cocok dengan pencarian Anda.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $books->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>