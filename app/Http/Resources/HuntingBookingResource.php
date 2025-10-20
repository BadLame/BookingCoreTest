<?php

namespace App\Http\Resources;

use App\Models\HuntingBooking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HuntingBookingResource extends JsonResource
{
    function toArray(Request $request): array
    {
        /** @var HuntingBooking $b */
        $b = $this->resource;

        return [
            'id' => $b->id,
            'tour_name' => $b->tour_name,
            'hunter_name' => $b->hunter_name,
            'date' => $b->date->format('d.m.Y'),
            'guide_id' => $b->guide_id,
            'participants_count' => $b->participants_count,
            'guide' => $this->whenLoaded(
                'guide',
                fn () => new GuideResource($b->guide)
            ),
        ];
    }
}
