<?php
namespace App\Action\Card;

use App\Models\Card;
use App\Models\Deck;
use App\Queries\Card\GetCardsFromDeckQuery;
use App\Verification\Card\ThisCardBelongsToTheUser;
use App\Verification\Deck\ThisDeckBelongsToTheUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class AddCardToDeckAction
{

    public static function execute(SupportCollection $collection): Collection
    {
        $userId = $collection->get('user_id');
        $deckId = $collection->get('deck_id');
        $cardId = $collection->get('card_id');

        $card = Card::findOrFail($cardId);
        $deck = Deck::findOrFail($deckId);
        if (!ThisDeckBelongsToTheUser::check($deck, $userId)) {
            throw new Exception('Колода не принадлежит пользователю');
        }
        if (!ThisCardBelongsToTheUser::check($card, $userId)) {
            throw new Exception('Данная карта(id:' . $cardId . ') не пренадлежит пользователю(id:' . $userId . ')');
        }

        $deck->cards()->attach($card);
        return getCardsFromDeckQuery::find($userId, $deckId);
    }

}
