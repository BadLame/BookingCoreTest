<?php

namespace Database\Factories;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Guide> */
class GuideFactory extends Factory
{
    function definition(): array
    {
        return [
            'name' => fake()->name(),
            'experience_years' => rand(1, 10),
            'is_active' => !!rand(0, 1),
        ];
    }
}
