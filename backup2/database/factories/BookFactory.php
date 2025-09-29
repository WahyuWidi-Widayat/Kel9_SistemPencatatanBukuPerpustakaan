<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'genre' => fake()->randomElement(['Fiksi', 'Fantasi', 'Misteri', 'Sains', 'Sejarah']),
            'synopsis' => fake()->paragraph(5),
        ];
    }
}