<?php

namespace Database\Factories;

use App\Gif\Giphy;
use App\Models\Word;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $repeats = rand(0, 10000);
        $level = 0;
        if ($repeats >= 2000) {
            $level = 2;
        } else if ($repeats >= 5000) {
            $level = 3;
        } else if ($repeats >= 10000) {
            $level = 4;
        }
        $word = Word::factory()->create();
        $gifs = Giphy::newClient()->generalSearch($word->value, 25);
        if($gifs == []){
            $gifs = [['src' => 'https://giphy.com/stickers/computer-dev-computador-f7omQNmgiyjj5sffvZ']];
        }
        $src = $gifs[rand(0,(count($gifs)-1))]['src'];
        return [
            'url' => $src,
            'level' => $level,
            'repeats' => $repeats,
            'word_id' => $word->id,
            'user_id' => User::factory()->create()->id,
        ];
    }
}
