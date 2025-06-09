<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['id' => 1, 'name' => 'Action'],
            ['id' => 2, 'name' => 'Adventure'],
            ['id' => 3, 'name' => 'Comedy'],
            ['id' => 4, 'name' => 'Drama'],
            ['id' => 5, 'name' => 'Fantasy'],
            ['id' => 6, 'name' => 'Horror'],
            ['id' => 7, 'name' => 'Romance'],
            ['id' => 8, 'name' => 'Sci-Fi'],
            ['id' => 9, 'name' => 'Thriller'],
        ]);
    }
}
