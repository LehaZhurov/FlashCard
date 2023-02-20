<?php

namespace Database\Factories;

use App\Translation\Translator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wolrd>
 */
class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $word = fake()->word();
        $translate = Translator::translate($word);
        return [
            'value' => $word,
            'data' => json_encode($translate, true),
        ];
    }
}
