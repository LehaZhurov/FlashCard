<?php

namespace Tests\Feature\Deck;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateDeckTest extends TestCase
{
    use RefreshDatabase;

    public $route = '/deck/create';

    public function test_succeess_create_deck()
    {
        $user = User::factory()->create();
        $name = Deck::factory()->definition()['name'];
        $response = $this->actingAs($user)
            ->post($this->route, ['name' => $name]);
        $response->assertStatus(201);

    }

    public function test_if_data_empty()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post($this->route, ['name' => ""]);
        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_if_user_not_autorized()
    {
        $name = Deck::factory()->definition()['name'];
        $response = $this->post($this->route, ['name' => $name]);
        $response->assertStatus(500);

    }

    public function test_response_structure()
    {
        $user = User::factory()->create();
        $name = Deck::factory()->definition()['name'];
        $response = $this->actingAs($user)
            ->post($this->route, ['name' => $name]);
        $responseStructure = [
            'data' => [
                'id',
                'name',
                'user_id',
                'created_at',
            ],
        ];
        $response->assertJsonStructure($responseStructure);
    }
}
