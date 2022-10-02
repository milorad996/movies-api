<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'genre' => $this->faker->randomElement(['Action','Adventure','Comedy','Drama','Fantasy','Horror','Musicals','Mystery','Romance','Thriller'])

        ];
    }
}
