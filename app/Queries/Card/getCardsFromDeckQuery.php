<?php
namespace App\Queries\Card;

use App\Models\Deck;
use Illuminate\Support\Collection;
use App\Queries\Deck\thisDeckBelongsToTheUserQuery;
class getCardsFromDeckQuery
{

    public static function find(int $userId, int $deckId): Collection
    {

        if (!thisDeckBelongsToTheUserQuery::check($userId, $deckId)) {
            throw new Exception('Колода(' . $deckId . ') не пренадлежит пользователю(' . $deckId . ')');
        }
        $deck = Deck::findOrFail($deckId)
            ->cards()
            ->join('words', 'words.id', '=', 'cards.word_id');
        return $deck->get();
    }

}
