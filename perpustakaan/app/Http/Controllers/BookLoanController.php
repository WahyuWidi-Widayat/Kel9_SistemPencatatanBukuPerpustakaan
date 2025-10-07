<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Jika user adalah admin, tampilkan semua peminjaman
        if (Auth::user()->is_admin) {
            $loans = BookLoan::with(['user', 'book'])->latest()->paginate(10);
            return view('admin.loans.index', compact('loans'));
        }
        
        // Jika user biasa, tampilkan hanya peminjaman miliknya
        $loans = BookLoan::with('book')->where('user_id', Auth::id())->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $book = Book::findOrFail(request('book_id'));
        return view('loans.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'loan_days' => 'required|integer|min:2|max:7',
        ]);

        $loanDate = Carbon::now();
        $dueDate = Carbon::now()->addDays($request->loan_days);

        BookLoan::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'status' => 'pending',
        ]);

        return redirect()->route('loans.index')->with('success', 'Permintaan peminjaman buku berhasil dikirim dan menunggu persetujuan admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = BookLoan::with(['user', 'book'])->findOrFail($id);
        
        // Pastikan hanya admin atau pemilik peminjaman yang bisa melihat detail
        if (!Auth::user()->is_admin && Auth::id() !== $loan->user_id) {
            abort(403);
        }
        
        return view('loans.show', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = BookLoan::findOrFail($id);
        
        // Hanya admin yang bisa mengubah status peminjaman
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        
        $request->validate([
            'status' => 'required|in:approved,rejected,returned',
            'notes' => 'nullable|string|max:255',
        ]);
        
        $loan->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'return_date' => $request->status === 'returned' ? Carbon::now() : $loan->return_date,
        ]);
        
        return redirect()->route('admin.loans.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = BookLoan::findOrFail($id);
        
        // Hanya admin yang bisa menghapus peminjaman
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        
        $loan->delete();
        
        return redirect()->route('admin.loans.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
