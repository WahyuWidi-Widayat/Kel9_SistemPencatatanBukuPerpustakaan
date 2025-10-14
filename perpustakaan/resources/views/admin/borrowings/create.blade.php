<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catat Peminjaman Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.borrowings.store') }}" method="POST">
                        @csrf
                        {{-- Pilih User --}}
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Pilih Buku --}}
                        <div class="mb-4">
                            <label for="book_id" class="block text-sm font-medium text-gray-700">Judul Buku (Hanya buku yang tersedia ditampilkan)</label>
                            <select name="book_id" id="book_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }} - {{ $book->author }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal Kembali --}}
                        <div class="mb-4">
                            <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal Pengembalian</label>
                            <input type="date" name="return_date" id="return_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.borrowings.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>