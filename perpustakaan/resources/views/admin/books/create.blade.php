<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div>
                            <x-input-label for="title" :value="__('Judul Buku')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="author" :value="__('Penulis')" />
                                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author')" required />
                                <x-input-error :messages="$errors->get('author')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="genre" :value="__('Genre')" />
                                <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="old('genre')" required />
                                <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="synopsis" :value="__('Sinopsis')" />
                            <textarea name="synopsis" id="synopsis" rows="5" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" required>{{ old('synopsis') }}</textarea>
                            <x-input-error :messages="$errors->get('synopsis')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="cover_image" :value="__('Gambar Cover')" />
                            <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end gap-4 pt-4">
                            <a href="{{ route('admin.books.index') }}">
                                <x-secondary-button type="button">
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Buku') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>