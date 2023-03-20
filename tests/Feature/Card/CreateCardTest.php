<?php

namespace Tests\Feature\Card;

use App\Action\Word\CreateWordAction;
use App\Models\Card;
use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCardTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/card/create';

    public function test_succeess_create_card()
    {
        $user = User::factory()->create();
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->create()->value;

        $response = $this->actingAs($user)
            ->post($this->route, ['word' => $word, 'gif' => $gif]);
        $response->assertStatus(200);

    }

    public function test_if_not_found_word()
    {
        $user = User::factory()->create();
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->word('green')->definition()['value'];

        $response = $this->actingAs($user)
            ->post($this->route, ['word' => $word, 'gif' => $gif]);

        $response->assertStatus(500);
    }

    public function test_if_data_empty()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post($this->route, ['word' => "", 'gif' => ""]);
        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_if_user_not_autorized()
    {
        $gif = Card::factory()->definition()['url'];
        $word = Word::factory()->create()->value;
        $response = $this->post($this->route, ['word' => $word, 'gif' => $gif]);
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
            ->post($this->route, ['word' => $word, 'gif' => $gif]);

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
            ->post($this->route, ['word' => $word, 'gif' => $gif]);
        $userBalance = User::find($user->id)->balance;
        $this->assertEquals($userBalance, 0);
    }

    public function test_response_structure()
    {
        $user = User::factory()->create();
        $gif = Card::factory()->definition()['url'];
        $word = CreateWordAction::execute('red')->value;

        $response = $this->actingAs($user)
            ->post($this->route, ['word' => $word, 'gif' => $gif]);
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
