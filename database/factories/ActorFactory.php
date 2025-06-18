<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'born_date' => $this->faker->date(),
            'photo' => $this->faker->imageUrl(640, 480, 'people'),
            'description' => $this->faker->paragraph(1),
            'gender' => $this->faker->boolean(),
        ];
    }
}
