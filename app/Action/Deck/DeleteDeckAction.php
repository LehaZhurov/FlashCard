<?php
namespace App\Action\Deck;

use App\Models\Deck;
use App\Verification\Deck\ThisDeckBelongsToTheUser;

class DeleteDeckAction
{

    public static function execute(int $userId, int $deckId): void
    {
        $deck = Deck::findOrFail($deckId);
        if (!ThisDeckBelongsToTheUser::check($deck, $userId)) {
            throw new Exception('Колода не пренадлежит пользователю');
        }
        $deck->cards()->detach();
        $deck->delete();
    }

}
