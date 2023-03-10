<?php

namespace Tests\Feature\Deck;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetDecksTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/deck/getDecks';

    public function test_succeess_get_decks()
    {
        $deckCount = 10;
        $user = User::factory()->create();
        $decks = Deck::factory()
            ->state(['user_id' => $user->id])
            ->count($deckCount)
            ->create();
        $response = $this
            ->actingAs($user)
            ->get($this->route);
        $response->assertJsonPath('pagination.total', $deckCount);
    }

    public function test_get_decks_if_user_not_autorized()
    {
        $deckCount = 10;
        $user = User::factory()->create();
        $decks = Deck::factory()
            ->state(['user_id' => $user->id])
            ->count($deckCount)
            ->create();
        $response = $this->get($this->route);
        $response->assertStatus(500);

    }

    public function test_response_structure()
    {
        $deckCount = 10;
        $user = User::factory()->create();
        $decks = Deck::factory()
            ->state(['user_id' => $user->id])
            ->count($deckCount)
            ->create();
        $response = $this
            ->actingAs($user)
            ->get($this->route);
        $responseStructure = [
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'user_id',
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

    public function test_response_structure_if_user_not_decks()
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
