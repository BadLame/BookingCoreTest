<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guide\GuidesListRequest;
use App\Http\Resources\GuideResource;
use App\Models\Guide;

class GuidesController extends Controller
{
    /** Список всех активных гидов */
    function list(GuidesListRequest $request)
    {
        return GuideResource::collection(
            Guide::query()
                ->active()
                ->minExperience($request->min_experience)
                ->get()
        );
    }
}
