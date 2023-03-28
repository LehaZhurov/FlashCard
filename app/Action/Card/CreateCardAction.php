<?php
namespace App\Action\Card;

use App\Action\User\TakeAwayFromTheBalanceAction;
use App\Models\Card;
use App\Queries\Word\SearchWordQuery;
use App\Verification\User\CanBeWrittenOffFromTheBalance;
use Exception;
use Illuminate\Support\Collection;

class CreateCardAction
{

    public static function execute(Collection $collection): Card
    {
        $userId = $collection->get('user_id');
        $word = $collection->get('word');
        $gif = $collection->get('gif');
        $cardPrice = 1000;
        $wordId = SearchWordQuery::execute($word)->id;

        if (!CanBeWrittenOffFromTheBalance::check($userId, $cardPrice)) {
            throw new Exception('Не достаточно пыли');
        }

        $card = new Card;
        $card->url = $gif;
        $card->user_id = $userId;
        $card->word_id = $wordId;
        $card->save();

        TakeAwayFromTheBalanceAction::execute($userId, $cardPrice);

        return $card;
    }

}
