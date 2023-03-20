<?php

namespace Tests\Feature\Deck;

use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetDecksCardsTest extends TestCase
{
    use RefreshDatabase;

    public function route($deckId)
    {
        return "/deck/" . $deckId . "/cards";
    }

    public function test_succeess_get_cards_from_deck()
    {
        $cardCount = 10;
        $user = User::factory()->create();
        $cards = Card::factory()
            ->state(['user_id' => $user->id])
            ->count($cardCount)
            ->create();
        $deck = Deck::factory()
            ->state(['user_id' => $user->id])
            ->create();
        $deckId = $deck->id;
        $deck->cards()
            ->attach($cards);
        $response = $this
            ->actingAs($user)
            ->get($this->route($deckId));
        $response->assertStatus(200);
    }

    public function test_get_cards_from_deck_if_user_not_autorized()
    {
        $cardCount = 10;
        $user = User::factory()->create();
        $cards = Card::factory()
            ->state(['user_id' => $user->id])
            ->count($cardCount)
            ->create();
        $deck = Deck::factory()
            ->state(['user_id' => $user->id])
            ->create();
        $deckId = $deck->id;
        $deck->cards()
            ->attach($cards);
        $response = $this
            ->get($this->route($deckId));
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
        $deck = Deck::factory()
            ->state(['user_id' => $user->id])
            ->create();
        $deckId = $deck->id;
        $deck->cards()
            ->attach($cards);
        $response = $this
            ->actingAs($user)
            ->get($this->route($deckId));
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
        ];
        $response->assertJsonStructure($responseStructure);
    }

    public function test_response_structure_if_deck_not_cards()
    {
        $user = User::factory()->create();

        $deck = Deck::factory()
            ->state(['user_id' => $user->id])
            ->create();
        $deckId = $deck->id;
        $response = $this
            ->actingAs($user)
            ->get($this->route($deckId));
        $responseStructure = [
            'data' => [],
        ];
        $response->assertExactJson($responseStructure);
    }

    public function test_if_deck_not_found()
    {
        $deckId = rand(100, 1000);
        $response = $this
            ->get($this->route($deckId));
        $response->assertStatus(500);

    }

    public function test_if_deck_not_belongss_user()
    {
        $user = User::factory()->create();
        $deck = Deck::factory()
            ->create();
        $deckId = $deck->id;
        $response = $this
            ->actingAs($user)
            ->get($this->route($deckId));
        $responseStructure = [
            'data' => [],
        ];
        $response->assertStatus(500);
    }
}
