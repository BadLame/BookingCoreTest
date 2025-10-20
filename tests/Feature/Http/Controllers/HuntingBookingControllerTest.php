<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Requests\HuntingBooking\HuntingBookingRequest;
use App\Models\Guide;
use App\Models\HuntingBooking;
use Tests\TestCase;

class HuntingBookingControllerTest extends TestCase
{
    function testBookWithValidDataWillSucceeded(): void
    {
        $guide = Guide::factory()->create();

        $date = now()->addDays(rand(1, 365));
        $participantsCount = rand(1, HuntingBooking::MAX_PARTICIPANTS_COUNT);

        $requestData = [
            'tour_name' => fake()->city(),
            'hunter_name' => fake()->name(),
            'guide_id' => $guide->id,
            'date' => $date->format(HuntingBookingRequest::DATE_FORMAT),
            'participants_count' => $participantsCount,
        ];

        $this->postJson(route('bookings.book'), $requestData)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'tour_name',
                    'hunter_name',
                    'date',
                    'participants_count',
                    'guide' => [
                        'id',
                        'name',
                        'experience_years',
                    ],
                ],
            ]);

        $this->assertDatabaseHas('hunting_bookings', [
            ...$requestData,
            'date' => $date->startOfDay(),
        ]);
    }

//    function testBookWithInvalidDateWillFail(): void
//    {
//        $guide = Guide::factory()->create();
//
//        $date = now()->addDays(rand(1, 365));
//        $participantsCount = rand(1, HuntingBooking::MAX_PARTICIPANTS_COUNT);
//
//        $validParams = [
//            'tour_name' => fake()->city(),
//            'hunter_name' => fake()->name(),
//            'guide_id' => $guide->id,
//            'participants_count' => $participantsCount,
//        ];
//        $todayDate = now()->endOfDay()->format(HuntingBookingRequest::DATE_FORMAT);
//        $wrongDateFormat = now()->addDays(5)->format('Y-m-d');
//
//        foreach ([$todayDate, $wrongDateFormat] as $date) {
//            $params = array_merge($validParams, ['date' => $date]);
//
//            $this->postJson(route('bookings.book'), $params)
//                ->dump()
//                ->assertStatus(422)
//                ->assertJsonValidationErrors('date');
//        }
//
//    }
}
