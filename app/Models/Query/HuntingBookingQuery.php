<?php

namespace App\Models\Query;

use App\Models\Guide;
use App\Models\HuntingBooking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/** @mixin HuntingBooking */
class HuntingBookingQuery extends Builder
{
    function ofDate(Carbon $date): static
    {
        return $this->where(
            fn (self $q) => $q->whereDate('hunting_bookings.date', $date)
        );
    }

    function ofGuide(Guide|int $guide): static
    {
        $guide = is_object($guide) ? $guide->id : $guide;
        return $this->where(
            fn (self $q) => $q->where('hunting_bookings.guide_id', $guide)
        );
    }
}
