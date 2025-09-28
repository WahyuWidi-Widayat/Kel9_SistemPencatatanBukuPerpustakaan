@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>

    <div class="grid grid-cols-3 gap-4">
        @foreach($books as $book)
            <div class="p-4 bg-white rounded shadow">
                <h2 class="text-lg font-semibold">{{ $book->title }}</h2>
                <p class="text-sm text-gray-600">Author: {{ $book->author }}</p>
                <a href="{{ route('books.show', $book) }}" class="text-blue-500">Lihat Detail</a>
            </div>
        @endforeach
    </div>
@endsection
