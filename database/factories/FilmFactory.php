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
            'link_trailer' => $this->faker->youtubeUri(),
            'duration' => $this->faker->numberBetween(60, 180),  // Duration in minutes
            'poster' => $this->faker->imageUrl(480, 720),  // Using Picsum for better movie posters
            'rating' => 0,
        ];
    }
}
