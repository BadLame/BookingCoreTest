<?php

namespace App\Http\Controllers;

use App\Http\Requests\HuntingBooking\HuntingBookingRequest;
use App\Http\Resources\HuntingBookingResource;
use App\Models\HuntingBooking;

class HuntingBookingController extends Controller
{
    function book(HuntingBookingRequest $request)
    {
        $booking = HuntingBooking::query()->create(
            $request->toDto()
        );

        return new HuntingBookingResource($booking->load('guide'));
    }
}
