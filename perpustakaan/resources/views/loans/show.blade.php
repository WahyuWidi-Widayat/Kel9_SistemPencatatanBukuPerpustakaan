<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">{{ $loan->book->title }}</h3>
                        <p class="text-sm text-gray-600">Oleh: {{ $loan->book->author }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Peminjaman</p>
                            <p>{{ $loan->loan_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jatuh Tempo</p>
                            <p>{{ $loan->due_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <p>
                                @if ($loan->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Persetujuan
                                    </span>
                                @elseif ($loan->status == 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @elseif ($loan->status == 'rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @elseif ($loan->status == 'returned')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Dikembalikan ({{ $loan->return_date->format('d/m/Y') }})
                                    </span>
                                @endif
                            </p>
                        </div>
                        @if ($loan->notes)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Catatan</p>
                            <p>{{ $loan->notes }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('loans.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Kembali ke Daftar Peminjaman</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>