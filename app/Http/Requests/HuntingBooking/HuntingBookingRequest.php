<?php

namespace App\Http\Requests\HuntingBooking;

use App\Models\HuntingBooking;
use Carbon\Exceptions\InvalidFormatException;
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

    protected $stopOnFirstFailure = true;

    public ?Carbon $date;

    function rules(): array
    {
        return [
            'tour_name' => 'required|string',
            'hunter_name' => 'required|string|between:2,255',
            'guide_id' => [
                'required',
                'integer',
                Rule::exists('guides', 'id')
                    ->where('is_active', true),
            ],
            'participants_count' => 'required|integer|min:1|max:' . HuntingBooking::MAX_PARTICIPANTS_COUNT,
            'date' => [
                'bail',
                'required',
                Rule::date()->after(today())->format(static::DATE_FORMAT),
            ],
        ];
    }

    function after(): array
    {
        return [
            function (Validator $v) {
                // Эта функция вызывается несмотря на $stopOnFirstFailure = true и bail вместе с падением по формату даты.
                // Пришлось использовать try/catch в этом месте
                try {
                    $this->date = Carbon::createFromFormat(static::DATE_FORMAT, $this->input('date'));
                } catch (InvalidFormatException) {
                    return;
                }

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
        return $this->safe()->merge(['date' => $this->date])->all();
    }
}
