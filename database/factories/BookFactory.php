<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(1),
            'year_published' => $this->faker->year(),
            'isbn' => $this->faker->isbn13(),
            'author_id' => Author::all()->random()->id,
        ];
    }
}
