<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    protected $model = Film::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3, true),
            'description' => $this->faker->paragraph(1),
            'release_date' => $this->faker->date(),
            'link_trailer' => 'https://www.youtube.com/watch?v=1Q8fG0TtVAY', // URL asli trailer
            'duration' => $this->faker->numberBetween(60, 180),
            'poster' => 'https://image.tmdb.org/t/p/w500/8UlWHLMpgZm9bx6QYh0NFoq67TZ.jpg', // Poster asli dari TMDb
            'rating' => 0,
        ];
    }

}
