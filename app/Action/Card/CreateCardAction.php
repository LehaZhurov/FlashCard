<?php
namespace App\Action\Card;

use App\Action\User\CanBeWrittenOffFromTheBalanceAction;
use App\Action\User\takeAwayFromTheBalanceAction;
use App\Action\Word\SearchWordAction;
use App\Models\Card;
use App\Queries\Card\getCardFromIdQuery;
use Illuminate\Support\Collection;

class CreateCardAction
{

    public static function execute(Collection $collection): Card
    {
        $userId = $collection->get('user_id');
        $word = $collection->get('word');
        $gif = $collection->get('gif');
        $cardPrice = 1000;
        $wordId = SearchWordAction::execute($word)->id;

        if (!CanBeWrittenOffFromTheBalanceAction::execute($userId, $cardPrice)) {
            throw new Exception('Не достаточно пыли');
        }

        $card = new Card;
        $card->url = $gif;
        $card->user_id = $userId;
        $card->word_id = $wordId;
        $card->save();

        takeAwayFromTheBalanceAction::execute($userId, $cardPrice);

        return getCardFromIdQuery::find($card->id);
    }

}
