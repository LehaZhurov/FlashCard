<?php
namespace App\Action\Deck;

use App\Models\Deck;
use App\Queries\Deck\thisDeckBelongsToTheUserQuery;
class DeleteDeckAction
{

    public static function execute(int $userId, int $deckId): void
    {
        if(!thisDeckBelongsToTheUserQuery::check($userId, $deckId)){
            throw new Exception('Колода не пренадлежит пользователю');
        }
        $deck = Deck::findOrFail($deckId);
        $deck->cards()->detach();
        $deck->delete();
    }

}
