<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'    => $this->faker->sentence(3),
            'author'   => $this->faker->name(),
            'genre'    => $this->faker->randomElement(['Fiksi', 'Non-Fiksi', 'Sains', 'Sejarah']),
            'synopsis' => $this->faker->paragraph(),
            'year'     => $this->faker->year(),
        ];
    }
}

