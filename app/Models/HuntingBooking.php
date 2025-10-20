<?php

namespace App\Models;

use App\Models\Query\HuntingBookingQuery;
use Database\Factories\HuntingBookingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $tour_name
 * @property string $hunter_name
 * @property int $guide_id
 * @property Carbon $date
 * @property int $participants_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Guide $guide
 *
 * @method static HuntingBookingFactory factory($count = null, $state = [])
 * @method static HuntingBookingQuery|HuntingBooking query()
 *
 * @mixin HuntingBookingQuery
 */
class HuntingBooking extends Model
{
    use HasFactory;

    const MAX_PARTICIPANTS_COUNT = 10;

    protected $casts = [
        'date' => 'date',
    ];

    protected $fillable = [
        'tour_name',
        'hunter_name',
        'date',
        'guide_id',
        'participants_count',
    ];

    // Relations

    function guide(): BelongsTo
    {
        return $this->belongsTo(Guide::class);
    }

    // Accessors & Mutators

    function setDateAttribute(Carbon $date): void
    {
        // Для чистоты даты в БД (чтобы не было часов/минут/секунд)
        $this->attributes['date'] = $date->startOfDay();
    }

    // Misc

    function newEloquentBuilder($query): HuntingBookingQuery
    {
        return new HuntingBookingQuery($query);
    }
}
