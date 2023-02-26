<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCardTest extends TestCase
{
    use RefreshDatabase;

    public function test_succeess_create_card()
    {

        $user = User::factory()->create();
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->create()->value;

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/card/create', ['word' => $word, 'gif' => $gif]);
        $response->assertStatus(200);

    }

    public function test_if_not_found_word()
    {
        $user = User::factory()->create();
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->definition()['value'];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/card/create', ['word' => $word, 'gif' => $gif]);

        $response->assertStatus(500);
    }

    public function test_if_data_empty()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/card/create', ['word' => "", 'gif' => ""]);
        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_if_user_not_autorized()
    {
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->create()->value;
        $response = $this->post('/card/create', ['word' => $word, 'gif' => $gif]);
        $response->assertStatus(500);

    }

    public function test_if_user_balance_less_than_a_1000()
    {
        $user = User::factory()->state([
            'balance' => 10,
        ])->create();
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->definition()['value'];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/card/create', ['word' => $word, 'gif' => $gif]);

        $response->assertStatus(500);
    }

    public function test_check_debiting_1000_from_the_users_balance()
    {
        $user = User::factory()->state([
            'balance' => 1000,
        ])->create();
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->create()->value;

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/card/create', ['word' => $word, 'gif' => $gif]);
        $userBalance = User::find($user->id)->balance;
        $this->assertEquals($userBalance, 0);
    }
}
