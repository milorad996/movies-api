<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        


        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(400,300),
            'genre' => $this->faker->randomElement(['Action','Adventure','Comedy','Drama','Fantasy','Horror','Musicals','Mystery','Romance','Thriller'])
        ];
    }
}
