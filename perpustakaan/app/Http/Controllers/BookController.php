<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request
    {
        $query = Book::query();

        // 1. Logika Pencarian (Sudah ada)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }

        // 2. Logika Sorting (BARU)
        $sort = $request->get('sort', 'latest'); // Default 'latest'

        switch ($sort) {
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'author_asc':
                $query->orderBy('author', 'asc');
                break;
            case 'author_desc':
                $query->orderBy('author', 'desc');
                break;
            default:
                $query->latest(); // 'latest' (created_at desc)
                break;
        }

        // 3. Paginasi (Sudah ada)
        $books = $query->paginate(12);

        return view('home', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}

