<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pinjam Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">Oleh: {{ $book->author }}</p>
                    </div>

                    <form method="POST" action="{{ route('loans.store') }}">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">

                        <div class="mb-4">
                            <label for="loan_days" class="block text-sm font-medium text-gray-700">Durasi Peminjaman (hari)</label>
                            <select id="loan_days" name="loan_days" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @for ($i = 2; $i <= 7; $i++)
                                    <option value="{{ $i }}">{{ $i }} hari</option>
                                @endfor
                            </select>
                            @error('loan_days')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('book.show', $book) }}" class="text-sm text-gray-600 hover:text-gray-900">Kembali</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>