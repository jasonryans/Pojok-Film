<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use Bluemmb\Faker\PicsumPhotosProvider;
use Faker\Provider\Youtube;

class FilmFactory extends Factory
{
    protected $model = Film::class;

    public function __construct()
    {
        parent::__construct();
        $this->faker->addProvider(new PicsumPhotosProvider($this->faker));
        $this->faker->addProvider(new Youtube($this->faker));
    }

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3, true),
            'description' => $this->faker->paragraph(1),
            'release_date' => $this->faker->date(),
            'link_trailer' => $this->faker->youtubeUri(),
            'duration' => $this->faker->numberBetween(60, 180),  // Duration in minutes
            'poster' => $this->faker->imageUrl(640, 480),  // Using Picsum for better movie posters
            'rating' => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}
