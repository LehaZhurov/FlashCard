<?php

namespace Tests\Feature\Card;

use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddCardToDeckTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/card/addToDeck';

    public function test_succeess_add_card_to_deck()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $request = ['card_id' => $card->id, 'deck_id' => $deck->id];
        $response = $this->actingAs($user)->post($this->route, $request);
        $response->assertStatus(200);
    }

    public function test_if_user_not_auto()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $request = ['card_id' => $card->id, 'deck_id' => $deck->id];
        $response = $this->post($this->route, $request);
        $response->assertStatus(500);
    }

    public function test_if_deck_not_belongs_user()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $deck = Deck::factory()->create();

        $request = ['card_id' => $card->id, 'deck_id' => $deck->id];
        $response = $this->post($this->route, $request);
        $response->assertStatus(500);
    }

    public function test_if_card_not_belongs_user()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $request = ['card_id' => $card->id, 'deck_id' => $deck->id];
        $response = $this->post($this->route, $request);
        $response->assertStatus(500);
    }

    public function test_response_structure()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $request = ['card_id' => $card->id, 'deck_id' => $deck->id];
        $response = $this->actingAs($user)->post($this->route, $request);
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

    public function test_if_data_empty()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $request = ['card_id' => '', 'deck_id' => ''];
        $response = $this->actingAs($user)->post($this->route, $request);
        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_if_card_not_found()
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $request = ['card_id' => rand(1, 1000), 'deck_id' => $deck->id];
        $response = $this->actingAs($user)->post($this->route, $request);
        $response->assertStatus(404);
    }

    public function test_if_deck_not_found()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $request = ['card_id' => $card->id, 'deck_id' => rand(1, 1000)];
        $response = $this->actingAs($user)->post($this->route, $request);
        $response->assertStatus(404);
    }

}
