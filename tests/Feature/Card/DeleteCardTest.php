<?php

namespace Tests\Feature\Card;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCardTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/card/delete';

    public function test_succeess_delete_card()
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

    public function test_check_accrual_by_card_level()
    {
        $user = User::factory()->state([
            'balance' => 1000,
        ])->create();
        $userBalanceBeforeDelete = $user->balance;
        $card = Card::factory()->state([
            'user_id' => $user->id,
        ])->create();

        $amountОfDustPerCard = [0, 200, 400, 500, 1000];
        $amount = $amountОfDustPerCard[$card->level];

        $response = $this->actingAs($user)->get($this->route . '/' . $card->id);

        $userBalanceAfterDelete = User::find($user->id)->balance;
        $supposedUserBalanceAfterDelete = (int) $userBalanceBeforeDelete + (int) $amount;
        $this->assertEquals($userBalanceAfterDelete, $supposedUserBalanceAfterDelete);
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
            'data'
        ];
        $response->assertJsonStructure($responseStructure);
    }
}
