<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\User;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


/**
 * Seeder intended for development purposes.
 * It creates a set of users, actors, films, and reviews to populate the database.
 * This is useful for testing and development, providing a realistic dataset.
 */
class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Run the genre seeder first
        $this->call(GenreSeeder::class);

        // Create admin user
        User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create regular users
        User::factory(5)->create();

        // Create actors
        Actor::factory(20)->create();

        // Create films with actors and reviews
        Film::factory(15)
            ->create()
            ->each(function ($film) {
                // Attach 3 random actors
                $actorIds = Actor::inRandomOrder()->take(3)->pluck('id');
                $film->actors()->attach($actorIds);

                // Attach 1-3 genres
                $genreIds = Genre::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $film->genres()->attach($genreIds);

                // Create reviews
                $reviews = Review::factory(rand(1, 5))->create([
                    'film_id' => $film->id,
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);

                $averageRating = $reviews->avg('rating');

                // Simpan ke kolom rating di tabel film
                $film->update([
                    'rating' => round($averageRating,2),
                ]);
            });

    }
}
