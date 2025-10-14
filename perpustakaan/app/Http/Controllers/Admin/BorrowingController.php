<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    /**
     * Menampilkan daftar semua data peminjaman.
     */
    public function index()
    {
        // Mengambil data dengan relasi user dan book, diurutkan, dan dipaginasi
        $borrowings = Borrowing::with(['user', 'book'])->latest()->paginate(10);
        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * Menampilkan form untuk membuat data peminjaman baru.
     */
    public function create()
    {
        // Mengambil semua user (role 'user') dan semua buku yang tersedia
        $users = User::where('role', 'user')->get();
        $books = Book::where('status', 'AVAILABLE')->get();
        return view('admin.borrowings.create', compact('users', 'books'));
    }

    /**
     * Menyimpan data peminjaman baru dari form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'return_date' => 'required|date|after:today',
        ]);

        $book = Book::findOrFail($request->book_id);
        if ($book->status !== 'AVAILABLE') {
            return back()->with('error', 'Buku ini sedang tidak tersedia.');
        }

        $borrowDate = Carbon::now();
        $returnDate = Carbon::parse($request->return_date);
        
        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $borrowDate->toDateString(),
            'return_date' => $returnDate->toDateString(),
            'status' => 'BORROWED',
        ]);

        $book->status = 'BORROWED';
        $book->save();

        return redirect()->route('admin.borrowings.index')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data peminjaman.
     */
    public function edit(Borrowing $borrowing)
    {
        return view('admin.borrowings.edit', compact('borrowing'));
    }

    /**
     * Memperbarui data peminjaman di database.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'return_date' => 'required|date',
            'status' => 'required|in:BORROWED,RETURNED',
        ]);

        $borrowing->update($request->only('return_date', 'status'));

        // Jika status diubah menjadi RETURNED, ubah status buku menjadi AVAILABLE
        if ($request->status == 'RETURNED') {
            $book = $borrowing->book;
            $book->status = 'AVAILABLE';
            $book->save();
        }

        return redirect()->route('admin.borrowings.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    /**
     * Menghapus data peminjaman dari database.
     */
    public function destroy(Borrowing $borrowing)
    {
        // Sebelum menghapus, pastikan status buku dikembalikan jika masih dipinjam
        if ($borrowing->status == 'BORROWED') {
            $book = $borrowing->book;
            $book->status = 'AVAILABLE';
            $book->save();
        }
        
        $borrowing->delete();

        return redirect()->route('admin.borrowings.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}