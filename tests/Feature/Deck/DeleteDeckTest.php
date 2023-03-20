<?php

namespace Tests\Feature\Deck;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteDeckTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/deck/delete';

    public function test_succeess_delete_deck()
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $response = $this->actingAs($user)->get($this->route . '/' . $deck->id);
        $response->assertStatus(200);
    }

    public function test_if_user_not_autorized()
    {
        $deck = Deck::factory()->create();
        $response = $this->get($this->route . '/' . $deck->id);
        $response->assertStatus(500);
    }

    public function test_if_deck_not_found()
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->make();
        $response = $this->actingAs($user)->get($this->route . '/' . $deck->id);
        $response->assertStatus(404);
    }

    public function test_if_deck_does_not_belongss_user()
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->create();
        $response = $this->actingAs($user)->get($this->route . '/' . $deck->id);
        $response->assertStatus(500);
    }

   

    public function test_response_structure()
    {
        $user = User::factory()->create();
        $deck = Deck::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $response = $this->actingAs($user)->get($this->route . '/' . $deck->id);
        $responseStructure = [
            'data'
        ];
        $response->assertJsonStructure($responseStructure);
    }
}
