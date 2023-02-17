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
            ->RightJoin('words', 'words.id', '=', 'cards.word_id')
            ->select(
                'cards.id', 'cards.level', 'cards.url',
                'cards.user_id', 'cards.created_at', 'cards.repeats',
                'words.value', 'words.data'
            )
            ->orderBy('cards.id', 'DESC');;
        return $deck->get();
    }

}
