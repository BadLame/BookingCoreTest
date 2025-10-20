<?php

namespace App\Http\Resources;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuideResource extends JsonResource
{
    function toArray(Request $request): array
    {
        /** @var Guide $g */
        $g = $this->resource;

        return [
            'id' => $g->id,
            'name' => $g->name,
            'experience_years' => $g->experience_years,
        ];
    }
}
