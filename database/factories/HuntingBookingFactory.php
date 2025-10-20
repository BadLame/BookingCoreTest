<?php

namespace Database\Factories;

use App\Models\Guide;
use App\Models\HuntingBooking;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<HuntingBooking> */
class HuntingBookingFactory extends Factory
{
    function definition(): array
    {
        return [
            'tour_name' => fake()->city(),
            'hunter_name' => fake()->name(),
            'guide_id' => Guide::factory(),
            'date' => now()->addDays(rand(1, 365)),
            'participants_count' => rand(1, HuntingBooking::MAX_PARTICIPANTS_COUNT),
        ];
    }
}
