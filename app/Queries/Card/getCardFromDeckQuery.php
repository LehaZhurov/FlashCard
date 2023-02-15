<?php
namespace App\Queries\Card;

use App\Models\Deck;
use Illuminate\Support\Collection;

class getCardFromDeckQuery
{

    public static function find(int $deckId): Collection
    {
        $deck = Deck::findOrFail($deckId)
            ->cards()
            ->join('words', 'words.id', '=', 'cards.word_id');
        return $deck->get();
    }

}
