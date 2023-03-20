<?php

namespace Tests\Feature\Translator;

use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TranslatorTest extends TestCase
{
    use RefreshDatabase;

    public $route = 'api/translation/';

    public function test_succeess_translator()
    {
        $word = 'green';
        $response = $this->get($this->route . $word);
        $response->assertStatus(200);
    }

    public function test_if_word_exec()
    {
        $word = Word::factory()->word('green')->create();
        $response = $this->get($this->route . $word->value);
        $response->assertStatus(200);
    }

    public function test_if_data_empty()
    {
        $response = $this->get($this->route . "    ");
        $response->assertStatus(200);
    }

    public function test_response_structure()
    {
        $word = 'green';
        $response = $this->get($this->route . $word);
        $response->assertStatus(200)->assertJsonStructure(
            [
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
        );
    }
}
