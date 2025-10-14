<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 p-4 border rounded-md bg-gray-50">
                        <p><strong>Peminjam:</strong> {{ $borrowing->user->name }}</p>
                        <p><strong>Buku:</strong> {{ $borrowing->book->title }}</p>
                    </div>

                    <form action="{{ route('admin.borrowings.update', $borrowing) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Tanggal Kembali --}}
                        <div class="mb-4">
                            <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal Pengembalian</label>
                            <input type="date" name="return_date" id="return_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $borrowing->return_date }}" required>
                        </div>
                        
                        {{-- Status Peminjaman --}}
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="BORROWED" @selected($borrowing->status == 'BORROWED')>Dipinjam</option>
                                <option value="RETURNED" @selected($borrowing->status == 'RETURNED')>Sudah Kembali</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.borrowings.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>