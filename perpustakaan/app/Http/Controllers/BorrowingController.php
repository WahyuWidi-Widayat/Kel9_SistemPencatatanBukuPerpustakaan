<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        // 1. Validasi input
        $request->validate([
            'return_date' => 'required|date|after:today',
        ]);

        // 2. Cek apakah buku tersedia
        if ($book->status !== 'AVAILABLE') {
            return back()->with('error', 'Buku ini sedang tidak tersedia untuk dipinjam.');
        }

        // 3. Validasi durasi peminjaman (2-7 hari)
        $borrowDate = Carbon::now();
        $returnDate = Carbon::parse($request->return_date);
        $duration = $borrowDate->diffInDays($returnDate);

        if ($duration < 2 || $duration > 7) {
            return back()->withErrors(['return_date' => 'Durasi peminjaman harus antara 2 hingga 7 hari.']);
        }
        
        // 4. Buat catatan peminjaman baru
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => $borrowDate->toDateString(),
            'return_date' => $returnDate->toDateString(),
        ]);

        // 5. Update status buku menjadi 'BORROWED'
        $book->status = 'BORROWED';
        $book->save();

        // 6. Redirect dengan pesan sukses
        return back()->with('success', 'Buku berhasil dipinjam!');
    }
}