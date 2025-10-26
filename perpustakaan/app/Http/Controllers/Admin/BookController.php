<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request
    {
        $query = Book::query();

        // Logika Sorting (BARU)
        // Cek apakah ada request 'sort' dan 'direction'
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        } else {
            // Default sort
            $query->latest();
        }

        $books = $query->paginate(10);

        // Kirim parameter sort ke view (untuk ikon panah)
        return view('admin.books.index', [
            'books' => $books,
            'sort' => $request->sort,
            'direction' => $request->direction,
        ]);
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'genre' => 'required|string|max:100',
        'synopsis' => 'required|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    $data = $request->all();

    if ($request->hasFile('cover_image')) {
        $path = $request->file('cover_image')->store('covers', 'public');
        $data['cover_image'] = $path;
    }

    Book::create($data);

    return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
}

    // method show, edit, update, destroy akan kita isi nanti
    public function show(Book $book) {}
     public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }
  public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'genre' => 'required|string|max:100',
        'synopsis' => 'required|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);

    $data = $request->all();

    if ($request->hasFile('cover_image')) {
        // Hapus gambar lama jika ada
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        // Simpan gambar baru
        $path = $request->file('cover_image')->store('covers', 'public');
        $data['cover_image'] = $path;
    }

    $book->update($data);

    return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui.');
}
    public function destroy(Book $book)
    {
        // 1. Hapus data buku dari database
        $book->delete();

        // 2. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}