<?php
namespace App\Action\Card;

use App\Action\User\CanBeWrittenOffFromTheBalanceAction;
use App\Action\Word\SearchWordAction;
use App\Models\Card;
use App\Queries\Card\getCardFromIdQuery;
use Illuminate\Support\Collection;
use App\Action\User\takeAwayFromTheBalanceAction;
class CreateCardAction
{

    public static function execute(Collection $collection): Card
    {
        $cardPrice = 1000;
        if (!CanBeWrittenOffFromTheBalanceAction::execute($collection->get('user_id'), $cardPrice)) {
            throw new Exception('Не достаточно пыли');
        }

        $wordId = SearchWordAction::execute($collection->get('word'))->id;
        $card = new Card;
        $card->url = $collection->get('gif');
        $card->user_id = $collection->get('user_id');
        $card->word_id = $wordId;
        $card->save();

        takeAwayFromTheBalanceAction::execute($collection->get('user_id'), $cardPrice);

        return getCardFromIdQuery::find($card->id);
    }

}
