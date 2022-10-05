<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Genre;
use App\Models\Like;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //  Genre::factory(10)->create()->each(function($genre) {
        //     Movie::factory(5)->create(['genre_id' => $genre->id]);
        //  });
         Movie::each(function($movie) {
            Like::factory(1)->create(['movie_id' => $movie->id]);
         });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
