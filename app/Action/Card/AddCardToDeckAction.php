<?php
namespace App\Action\Card;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Database\Eloquent\Collection;
use App\Queries\Card\getCardFromDeckQuery;
class AddCardToDeckAction
{

    public static function execute(int $cardId, int $deckId): Collection
    {
        $card = Card::findOrFail($cardId);
        $deck = Deck::findOrFail($deckId);
        $deck->cards()->attach($card);
        return getCardFromDeckQuery::find($deckId);
    }

}
