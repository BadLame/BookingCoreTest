<?php

namespace App\Http\Requests\HuntingBooking;

use App\Models\HuntingBooking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

/**
 * @property string $tour_name
 * @property string $hunter_name
 * @property Carbon $date
 * @property int $guide_id
 * @property int $participants_count
 */
class HuntingBookingRequest extends FormRequest
{
    const DATE_FORMAT = 'd.m.Y';

    public Carbon $date;

    function rules(): array
    {
        return [
            'tour_name' => 'bail|required|string',
            'hunter_name' => 'bail|required|string|between:2,255',
            'date' => [
                'bail',
                'required',
                Rule::date()->after(today())->format(static::DATE_FORMAT),
            ],
            'guide_id' => 'bail|required|integer|exists:guides,id',
            'participants_count' => 'bail|required|integer|min:1|max:' . HuntingBooking::MAX_PARTICIPANTS_COUNT,
        ];
    }

    function after(): array
    {
        return [
            fn () => $this->date = Carbon::createFromFormat(
                self::DATE_FORMAT,
                $this->input('date')
            ),
            function (Validator $v) {
                $otherBookingsForGuideValidationQuery = HuntingBooking::query()
                    ->ofDate($this->date)
                    ->ofGuide($this->guide_id);

                if ($otherBookingsForGuideValidationQuery->exists()) {
                    $v->errors()->add(
                        'guide_id',
                        'Guide already have tour for this date.'
                    );
                }
            },
        ];
    }

    function toDto(): array
    {
        return array_merge($this->validated(), ['date' => $this->date]);
    }
}
