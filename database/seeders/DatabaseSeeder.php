<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
        'name' => 'Test User',
        'username' => 'testuser', // ← Tambahkan ini!
        'email' => 'test@example.com',
        'is_admin' => 1, // ← TAMBAHKAN INI! 1=admin, 0=bukan admin
    ]);


        $this->call(GenreSeeder::class);
    }
}
