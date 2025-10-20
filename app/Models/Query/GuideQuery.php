<?php

namespace App\Models\Query;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Builder;

/** @mixin Guide */
class GuideQuery extends Builder
{
    /** Фильтрация по активности */
    function active(bool $active = true): static
    {
        return $this->where(
            fn (self $q) => $q->where('guides.is_active', $active)
        );
    }

    /** Фильтрация по минимальным годам опыта */
    function minExperience(?int $minExperience = null): static
    {
        return $this->where(
            fn (self $q) => $q->when($minExperience, fn (self $q) => $q->where(
                'guides.experience_years',
                '>=',
                $minExperience)
            )
        );
    }
}
