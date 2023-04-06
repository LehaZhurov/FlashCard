<?php

namespace Tests\Feature\Card;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpRepeatsCardTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/card/repeat';

    public function test_succeess_repeat_card()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $response = $this->actingAs($user)->get($this->route . '/' . $card->id);
        $response->assertStatus(200);
    }

    public function test_if_user_not_autorized()
    {
        $card = Card::factory()->create();
        $response = $this->get($this->route . '/' . $card->id);
        $response->assertStatus(500);
    }

    public function test_if_card_not_found()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->make();
        $response = $this->actingAs($user)->get($this->route . '/' . $card->id);
        $response->assertStatus(404);
    }

    public function test_check_up_count_repeats()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $cardRepeatsBeforeAdd = $card->repeats;
        $response = $this->actingAs($user)->get($this->route . '/' . $card->id)->decodeResponseJson();
        $response = json_decode($response->json);
        $countRepeatBeenAdd = $response->data->repeats - $cardRepeatsBeforeAdd;
        $this->assertEquals($countRepeatBeenAdd, 1);
    }

    public function test_if_card_does_not_belongs()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        $response = $this->actingAs($user)->get($this->route . '/' . $card->id);
        $response->assertStatus(500);
    }

    public function test_response_structure()
    {
        $user = User::factory()->create();
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();
        $response = $this->actingAs($user)->get($this->route . '/' . $card->id);
        $responseStructure = [
            'data' => [
                'id',
                'src',
                'word',
                'info',
                'repeats',
                'level',
                'created_at',
                'audio',
            ],
        ];
        $response->assertJsonStructure($responseStructure);
    }
}