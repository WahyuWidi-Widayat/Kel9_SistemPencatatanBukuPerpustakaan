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
                                        <h3 class="font-bold text-lg truncate">{{ $book->title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $book->author }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada buku di koleksi.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>