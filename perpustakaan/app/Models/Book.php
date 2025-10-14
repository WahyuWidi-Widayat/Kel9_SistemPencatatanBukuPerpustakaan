<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- BARIS INI HILANG
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'synopsis',
        'cover_image',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function borrowings()
{
    return $this->hasMany(Borrowing::class);
}

}