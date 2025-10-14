<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <a href="{{ route('admin.borrowings.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            + Catat Peminjaman Baru
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Buku</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($borrowings as $borrowing)
                                <tr>
                                    <td class="px-6 py-4">{{ $borrowing->user->name }}</td>
                                    <td class="px-6 py-4">{{ $borrowing->book->title }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrowing->borrow_date)->isoFormat('D MMM YYYY') }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrowing->return_date)->isoFormat('D MMM YYYY') }}</td>
                                    <td class="px-6 py-4">
                                        @if($borrowing->status == 'BORROWED')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Kembali
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex items-center gap-2">
                                        <a href="{{ route('admin.borrowings.edit', $borrowing) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <span class="text-gray-300">|</span>
                                        <form action="{{ route('admin.borrowings.destroy', $borrowing) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada data peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $borrowings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>