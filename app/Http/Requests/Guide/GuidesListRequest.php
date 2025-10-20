<?php

namespace App\Http\Requests\Guide;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int|null $min_experience
 */
class GuidesListRequest extends FormRequest
{
    function rules(): array
    {
        return [
            'min_experience' => ['sometimes', 'numeric', 'min:1'],
        ];
    }
}
