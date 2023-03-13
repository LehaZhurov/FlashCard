<?php
namespace App\Action\Card;

use App\Models\Card;
use App\Models\Deck;
use App\Queries\Card\getCardsFromDeckQuery;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class DeleteCardInDeckAction
{

    public static function execute(SupportCollection $collection): Collection
    {
        $userId = $collection->get('user_id');
        $deckId = $collection->get('deck_id');
        $cardId = $collection->get('card_id');

        $card = Card::findOrFail($cardId);
        $deck = Deck::findOrFail($deckId);
        if ($deck->user_id != $userId) {
            throw new Exception('Колода не принадлежит пользователю');
        }
        if (!$deck->card->contains($card)) {
            throw new Exception('Данная карта(' . $cardId . ') не из колоды(' . $deckId . ')');
        }
        $deck->cards()->detach($card);
        return getCardsFromDeckQuery::find($userId, $deckId);
    }

}
