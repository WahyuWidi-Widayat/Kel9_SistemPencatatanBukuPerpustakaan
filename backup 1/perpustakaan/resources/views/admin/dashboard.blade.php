<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang di Dashboard Admin!") }}
                    
                    <div class="mt-4">
                        <p>Dari sini Anda akan bisa:</p>
                        <ul class="list-disc list-inside">
                            <li>
                                <a href="{{ route('admin.books.index') }}" class="text-blue-600 hover:underline">
                                    Mengelola Buku (Tambah, Edit, Hapus)
                                </a>
                            </li>
                            <li>
    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">
        Mengelola User
    </a>
</li>
                            @if(auth()->user()->role === 'root')
                                <li class="font-bold">Mengelola Admin (Khusus Root)</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>