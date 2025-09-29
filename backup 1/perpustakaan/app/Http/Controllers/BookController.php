<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(12);
        return view('home', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
    public function destroy(Book $book)
    {
        // 1. Hapus data buku dari database
        $book->delete();

        // 2. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}