<?php
namespace App\Action\Card;

use App\Models\Card;
use App\Models\Deck;
use App\Queries\Card\getCardsFromDeckQuery;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class AddCardToDeckAction
{

    public static function execute(SupportCollection $collection): Collection
    {
        $card = Card::findOrFail($collection->get('card_id'));
        $deck = Deck::findOrFail($collection->get('deck_id'));
        if ($deck->user_id != $collection->get('user_id')) {
            throw new Exception('Колода не принадлежит пользователю');
        }
        $deck->cards()->attach($card);
        return getCardsFromDeckQuery::find($collection->get('user_id'), $collection->get('deck_id'));
    }

}
