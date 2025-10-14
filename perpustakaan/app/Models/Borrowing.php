<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    // Relasi: Satu peminjaman dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu peminjaman merujuk pada satu buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}