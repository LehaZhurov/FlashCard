<?php
namespace App\Action\Card;

use App\Models\Card;
use App\Models\Deck;
use App\Queries\Card\getCardsFromDeckQuery;
use Illuminate\Database\Eloquent\Collection;

class AddCardToDeckAction
{

    public static function execute(int $cardId, int $deckId, int $userId): Collection
    {
        $card = Card::findOrFail($cardId);
        $deck = Deck::findOrFail($deckId);
        $deck->cards()->attach($card);
        return getCardsFromDeckQuery::find($userId, $deckId);
    }

}
