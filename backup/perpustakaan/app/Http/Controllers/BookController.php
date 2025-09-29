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
}