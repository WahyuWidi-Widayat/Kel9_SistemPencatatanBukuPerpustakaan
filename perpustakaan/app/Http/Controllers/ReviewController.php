<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(Request $request, Book $book): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Simpan review baru
        Review::create([
          'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'book_id' => $book->id,
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect ke halaman detail buku dengan pesan sukses
        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Review berhasil ditambahkan.');
    }
}
