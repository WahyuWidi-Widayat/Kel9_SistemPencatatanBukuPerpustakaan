<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                   <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
                            <input type="text" name="author" id="author" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('author') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                            <input type="text" name="genre" id="genre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('genre') }}" required>
                        </div>
                        {{-- Tambahkan ini setelah input Genre --}}
<div class="mb-4">
    <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Cover</label>
    <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full">
</div>


                        <div class="mb-4">
                            <label for="synopsis" class="block text-sm font-medium text-gray-700">Sinopsis</label>
                            <textarea name="synopsis" id="synopsis" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('synopsis') }}</textarea>
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.books.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Buku</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>