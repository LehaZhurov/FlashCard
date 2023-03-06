<?php

namespace Database\Factories;

use App\Translation\Translator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wolrd>
 */
class WordFactory extends Factory
{

    public $word = 'test';
    public function word(string $word){
        $this->word = $word;
        return $this;
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $translate = Translator::translate($this->word);
        return [
            'value' => $this->word,
            'data' => json_encode($translate, true),
        ];
    }
}
