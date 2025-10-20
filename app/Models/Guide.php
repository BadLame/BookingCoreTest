<?php

namespace App\Models;

use App\Models\Query\GuideQuery;
use Database\Factories\GuideFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Гиды
 *
 * @property int $id
 * @property string $name
 * @property int $experience_years
 * @property bool $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<HuntingBooking> $bookings
 *
 * @method static GuideFactory factory($count = null, $state = [])
 * @method static Guide|GuideQuery query()
 *
 * @mixin GuideQuery
 */
class Guide extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'experience_years',
        'is_active',
    ];

    // Relations

    function bookings(): HasMany
    {
        return $this->hasMany(HuntingBooking::class);
    }

    // Misc

    function newEloquentBuilder($query): GuideQuery
    {
        return new GuideQuery($query);
    }
}
