<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/3">
                            <div class="h-96 bg-gray-300 flex items-center justify-center rounded-lg">
                                 <span class="text-gray-500">Cover Buku</span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-lg font-bold">Informasi Buku</h3>
                                <p><strong>Penulis:</strong> {{ $book->author }}</p>
                                <p><strong>Genre:</strong> {{ $book->genre }}</p>
                                <p><strong>Dibuat:</strong> {{ $book->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold border-b pb-2 mb-4">Sinopsis</h3>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $book->synopsis }}</p>
                            <hr class="my-8">
                            <h3 class="text-2xl font-bold border-b pb-2 mb-4">Ulasan</h3>
                            
                            @auth
                                <form action="{{ route('review.store', $book) }}" method="POST" class="mb-8">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="rating" class="block mb-1">Beri Bintang:</label>
                                        <select name="rating" id="rating" class="border-gray-300 rounded-md" required>
                                            <option value="5">★★★★★</option>
                                            <option value="4">★★★★☆</option>
                                            <option value="3">★★★☆☆</option>
                                            <option value="2">★★☆☆☆</option>
                                            <option value="1">★☆☆☆☆</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="comment" class="block mb-1">Komentar Anda:</label>
                                        <textarea name="comment" id="comment" rows="3" class="w-full border-gray-300 rounded-md" required></textarea>
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Kirim Ulasan</button>
                                </form>
                            @else
                                <p class="mb-8 text-center bg-gray-100 p-4 rounded-md">
                                    <a href="{{ route('login') }}" class="text-blue-600 font-bold">Login</a> untuk memberikan ulasan.
                                </p>
                            @endauth

                            <div class="space-y-4">
                                @forelse ($book->reviews as $review)
                                    <div class="border p-4 rounded-md">
                                        <div class="flex justify-between items-center">
                                            <span class="font-bold">{{ $review->user->name }}</span>
                                            <span class="text-yellow-500">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">{{ $review->comment }}</p>
                                        <small class="text-gray-400">{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                @empty
                                    <p class="text-gray-500">Belum ada ulasan untuk buku ini.</p>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>