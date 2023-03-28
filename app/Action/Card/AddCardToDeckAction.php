<?php
namespace App\Action\Card;

use App\Models\Card;
use App\Models\Deck;
use App\Queries\Card\GetCardsFromDeckQuery;
use App\Verification\Card\ThisCardBelongsToTheUser;
use App\Verification\Deck\CanAddMoreCardInDeck;
use App\Verification\Deck\ThisDeckBelongsToTheUser;
use Exception;
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
        if (!ThisDeckBelongsToTheUser::check($deck, $collection->get('user_id'))) {
            throw new Exception('Колода не принадлежит пользователю');
        }
        if (!ThisCardBelongsToTheUser::check($card, $collection->get('user_id'))) {
            throw new Exception('Данная карта(id:' . $cardId . ') не принадлежит пользователю(id:' . $userId . ')');
        }
        if (!CanAddMoreCardInDeck::check($deck)) {
            throw new Exception('В колоде больше нет мест');
        }
        $deck->cards()->attach($card);
        return GetCardsFromDeckQuery::find($userId, $deckId);
    }

}
