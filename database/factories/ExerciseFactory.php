<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'excerpt' => $this->faker->sentence(rand(2, 3), true),
            'complexity_id' => rand(1, 5),
            'user_id' => rand(1, 100),
            'block_id' => rand(1, 35),
            'active' => true,
            'time' => $this->faker->randomNumber(3),
        ];
    }
}
