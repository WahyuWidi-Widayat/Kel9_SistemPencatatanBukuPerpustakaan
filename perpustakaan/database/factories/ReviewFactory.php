<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Book;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'  => User::factory(),   // buat user otomatis
            'book_id'  => Book::factory(),   // buat buku otomatis
            'rating'   => $this->faker->numberBetween(1, 5),
            'comment'  => $this->faker->sentence(12),
        ];
    }
}
