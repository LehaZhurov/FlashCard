<?php
namespace App\Action\Card;

use App\Action\Word\SearchWordAction;
use App\Models\Card;
use App\Queries\Card\getCardFromIdQuery;
use Auth;

class CreateCardAction
{

    public static function execute(string $word, string $gif): Card
    {
        $userId = Auth::id();
        $wordId = SearchWordAction::execute($word)->id;
        $card = new Card;
        $card->url = $gif;
        $card->user_id = $userId;
        $card->word_id = $wordId;
        $card->save();
        return getCardFromIdQuery::find($card->id);
    }

}
