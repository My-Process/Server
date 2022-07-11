<?php

namespace Database\Factories;

use App\Enums\Models\PermissionEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'scope' => PermissionEnum::getRandomValue(),
            'name'  => $this->faker->unique()->word(),
            'slug'  => $this->faker->unique()->slug(),
        ];
    }
}
