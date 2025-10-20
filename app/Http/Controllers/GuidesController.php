<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuideResource;
use App\Models\Guide;

class GuidesController extends Controller
{
    /** Список всех активных гидов */
    function list()
    {
        return GuideResource::collection(
            Guide::query()->active()->get()
        );
    }
}
