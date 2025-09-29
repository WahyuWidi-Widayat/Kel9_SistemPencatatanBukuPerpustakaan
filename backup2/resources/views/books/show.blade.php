<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p class="font-bold">Sukses</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-1">
                            <div class="aspect-w-2 aspect-h-3 rounded-lg overflow-hidden shadow-lg">
                                @if ($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover {{ $book->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-500">Cover Tidak Tersedia</span>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-6 p-4 border dark:border-gray-700 rounded-lg">
                                <h3 class="font-bold text-lg mb-2">Informasi Buku</h3>
                                <div class="space-y-2 text-sm">
                                    <p><strong>Penulis:</strong><br><span class="text-gray-600 dark:text-gray-400">{{ $book->author }}</span></p>
                                    <p><strong>Genre:</strong><br><span class="text-gray-600 dark:text-gray-400">{{ $book->genre }}</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $book->title }}</h1>
                            <p class="text-lg text-gray-500 dark:text-gray-400 mt-1">oleh {{ $book->author }}</p>

                            <div class="mt-6 pt-6 border-t dark:border-gray-700">
                                <h3 class="font-semibold text-xl mb-2">Sinopsis</h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed whitespace-pre-wrap">{{ $book->synopsis }}</p>
                            </div>
                            
                            <div class="mt-8 pt-6 border-t dark:border-gray-700">
                                <h3 class="font-semibold text-xl mb-4">Ulasan Pengguna</h3>

                                @auth
                                    <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-lg mb-8 border dark:border-gray-700">
                                        <h4 class="font-semibold text-lg mb-4">Berikan Ulasan Anda</h4>
                                        {{-- Di baris berikutnya, 'reviews.store' diubah menjadi 'review.store' --}}
                                        <form action="{{ route('review.store', $book) }}" method="POST" class="space-y-4">
                                            @csrf
                                            <div>
                                                <x-input-label for="rating" :value="__('Rating (1-5)')" />
                                                <x-text-input id="rating" name="rating" type="number" class="mt-1 block w-full" min="1" max="5" required />
                                            </div>
                                            <div>
                                                <x-input-label for="comment" :value="__('Komentar')" />
                                                <textarea name="comment" id="comment" rows="4" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" required></textarea>
                                            </div>
                                            <div class="flex justify-end">
                                                <x-primary-button>
                                                    Kirim Ulasan
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="mb-8 text-center bg-gray-100 dark:bg-gray-700/50 p-6 rounded-lg">
                                        <p class="text-gray-700 dark:text-gray-300">
                                            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">Masuk</a> untuk memberikan ulasan.
                                        </p>
                                    </div>
                                @endauth

                                <div class="space-y-6">
                                    @forelse ($book->reviews as $review)
                                        <div class="p-5 border dark:border-gray-700 rounded-lg">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-bold text-gray-800 dark:text-gray-200">{{ $review->user->name }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $review->created_at->isoFormat('D MMMM YYYY') }}</p>
                                                </div>
                                                <div class="flex items-center text-yellow-500">
                                                    @for ($i = 0; $i < $review->rating; $i++) <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg> @endfor
                                                    @for ($i = $review->rating; $i < 5; $i++) <svg class="w-5 h-5 fill-current text-gray-300 dark:text-gray-600" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg> @endfor
                                                </div>
                                            </div>
                                            <p class="text-gray-600 dark:text-gray-300 mt-3">{{ $review->comment }}</p>
                                        </div>
                                    @empty
                                        <div class="p-6 text-center border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-lg">
                                            <p class="text-gray-500 dark:text-gray-400">Belum ada ulasan untuk buku ini. Jadilah yang pertama!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>