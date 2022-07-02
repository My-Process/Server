<?php

namespace Database\Factories;

use App\Enums\Models\PermissionEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name  = $this->faker->word();
        $scope = PermissionEnum::getRandomValue();

        return [
            'scope' => $scope,
            'name'  => $name,
            'slug'  => Str::slug("{$scope} {$name}"),
        ];
    }
}
