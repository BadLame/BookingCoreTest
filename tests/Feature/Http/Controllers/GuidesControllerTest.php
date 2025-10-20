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

    function testGuidesListExperienceFiltration(): void
    {
        $guides = [];
        $minYears = rand(5, 10);

        foreach (range(1, 10) as $experience_years) {
            $guides[] = Guide::factory()->active()->create(['experience_years' => $experience_years]);
        }

        $response = $this->getJson(
            route('guides.list', ['min_experience' => $minYears])
        );

        foreach ($guides as $guide) if ($guide->experience_years < $minYears) {
            $response->assertJsonMissing(['id' => $guide->id]);
        } else {
            $response->assertJsonFragment(['id' => $guide->id]);
        }
    }
}
