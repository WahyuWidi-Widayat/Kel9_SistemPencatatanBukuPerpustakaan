<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request; // <-- 1. Tambahkan ini

class BookController extends Controller
{
    // 2. Tambahkan Request $request di dalam parameter method
    public function index(Request $request)
    {
        // 3. Ganti logika lama dengan yang ini
        $query = Book::query();

        // Jika ada input pencarian dari form
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Cari di kolom 'title' ATAU 'author'
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }

        $books = $query->latest()->paginate(12);

        return view('home', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}