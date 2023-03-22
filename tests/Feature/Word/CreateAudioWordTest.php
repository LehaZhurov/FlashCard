<?php

namespace Tests\Feature\Word;

use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateAudioWordTest extends TestCase
{
    use RefreshDatabase;

    public $route = 'api/word/audio/create';

    public function test_succeess_audio_create_word()
    {
        $word = Word::factory()->word('green')->create()['value'];
        $response = $this->post($this->route, ['word' => $word])
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data', fn(AssertableJson $json) =>
                    $json
                        ->where('word', $word)
                        ->etc()
                )
            );
        $response->assertStatus(200);
    }

    public function test_if_word_exec()
    {
        $word = Word::factory()->word('green')->create();
        $response = $this->post($this->route, ['word' => $word->value])
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data', fn(AssertableJson $json) =>
                    $json
                        ->where('word', $word->value)
                        ->etc()
                )
            );
        $response->assertStatus(200);
    }

    public function test_if_data_empty()
    {
        $response = $this->post($this->route, ['word' => ""]);
        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_response_structure()
    {
        $word = Word::factory()->word('green')->create()['value'];
        $response = $this->post($this->route, ['word' => $word]);

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'id',
                'word',
                'audio',
                'info' => [
                    'dictionary' => [
                        "*" => [
                            'value',
                            'chat_speech',
                            'translation',
                        ],
                    ],
                    'translate',
                    'powered',
                ],
                'created_at',
            ],
        ]);
    }

    public function test_if_not_found_word()
    {
        $word = Word::factory()->word('pink')->definition()['value'];
        $response = $this->post($this->route, ['word' => $word]);
        $response->assertStatus(500);
    }
}
