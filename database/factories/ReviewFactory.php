<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'film_id' => Film::factory(),
            'user_id' => User::factory(),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'review' => $this->faker->paragraph(1),
        ];
    }
}
