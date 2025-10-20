<?php

namespace App\Models;

use App\Models\Query\GuideQuery;
use Database\Factories\GuideFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    // Misc

    function newEloquentBuilder($query): GuideQuery
    {
        return new GuideQuery($query);
    }
}
