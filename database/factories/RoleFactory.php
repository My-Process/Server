<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->unique()->jobTitle(),
            'slug'        => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(5),
        ];
    }
}
