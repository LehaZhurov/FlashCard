<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $cards = Card::factory()->state([
            'user_id' => 1
        ])->count(10)->create();
        foreach($cards as $card){
            echo "Card: " . $card->word_id.PHP_EOL;
        }
    }
}
