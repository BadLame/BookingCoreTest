<?php

namespace Feature\Http\Controllers;

use App\Models\Guide;
use Tests\TestCase;

class GuidesControllerTest extends TestCase
{
    function testListReturnsValidListOfGuides(): void
    {
        $guides = Guide::factory(rand(5, 10))->create();
        $activeGuides = $guides->filter(fn (Guide $guide) => $guide->is_active);
        $inactiveGuides = $guides->filter(fn (Guide $guide) => !$guide->is_active);

        $response = $this->getJson(route('guides.list'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'experience_years',
                    ],
                ],
            ]);

        foreach ($activeGuides as $guide) {
            $response->assertJsonFragment(['id' => $guide->id]);
        }
        foreach ($inactiveGuides as $guide) {
            $response->assertJsonMissing(['id' => $guide->id]);
        }
    }
}
