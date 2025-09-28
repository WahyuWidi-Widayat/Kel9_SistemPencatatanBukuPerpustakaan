<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Lihat semua buku
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                         ->orWhere('genre', 'like', "%$search%")
                         ->orWhere('synopsis', 'like', "%$search%");
        })->paginate(10);

        return view('books.index', compact('books', 'search'));
    }

    // Lihat detail buku
    public function show(Book $book)
    {
        $book->load('reviews.user');
        return view('books.show', compact('book'));
    }

    // Admin & Root: form tambah buku
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'year' => 'required|integer',
            'synopsis' => 'required',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'year' => 'required|integer',
            'synopsis' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}
