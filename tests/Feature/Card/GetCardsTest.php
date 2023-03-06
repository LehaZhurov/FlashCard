<?php

namespace Tests\Feature\Card;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetCardsTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/card/getCards';

    public function test_succeess_get_cards()
    {
        $cardCount = 10;
        $user = User::factory()->create();
        $cards = Card::factory()
            ->state(['user_id' => $user->id])
            ->count($cardCount)
            ->create();
        $response = $this
            ->actingAs($user)
            ->get($this->route);
        $response->assertJsonPath('pagination.total', $cardCount);
    }

    public function test_get_cards_if_user_not_autorized()
    {
        $cardCount = 10;
        $user = User::factory()->create();
        $cards = Card::factory()
            ->state(['user_id' => $user->id])
            ->count($cardCount)
            ->create();
        $response = $this->get($this->route);
        $response->assertStatus(500);

    }

    public function test_response_structure()
    {
        $cardCount = 10;
        $user = User::factory()->create();
        $cards = Card::factory()
            ->state(['user_id' => $user->id])
            ->count($cardCount)
            ->create();
        $response = $this
            ->actingAs($user)
            ->get($this->route);
        $responseStructure = [
            'data' => [
                '*' => [
                    'id',
                    'src',
                    'word',
                    'info',
                    'repeats',
                    'level',
                    'created_at',
                ],
            ],
            'pagination' => [
                'total',
                'per_page',
                'current_page',
                'count_item_current_page',
                'next_page_url',
                'prev_page_url',
                'last_page',
                'next_page',
                'prev_page',
            ],
        ];
        $response->assertJsonStructure($responseStructure);
    }

    public function test_response_structure_if_user_not_cards()
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get($this->route);

        $responseStructure = [
            'data' => [],
            'pagination' => [
                'total' => 0,
                'per_page' => 25,
                'next_page' => null,
                'prev_page' => null,
                'current_page' => 1,
                'count_item_current_page' => 0,
                'next_page_url' => null,
                'prev_page_url' => null,
                'last_page' => 1,
            ],
        ];
        $response->assertExactJson($responseStructure);
    }
}
