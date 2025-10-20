<?php

namespace App\Models\Query;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Builder;

/** @mixin Guide */
class GuideQuery extends Builder
{
    function active(bool $active = true): static
    {
        return $this->where(
            fn (self $q) => $q->where('guides.is_active', $active)
        );
    }
}
