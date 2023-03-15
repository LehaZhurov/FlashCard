<?php
namespace App\Action\Deck;

use App\Models\Deck;
use App\Verification\Deck\ThisDeckBelongsToTheUser;

class DeleteDeckAction
{

    public static function execute(int $userId, int $deckId): void
    {
        if (!ThisDeckBelongsToTheUser::check($userId, $deckId)) {
            throw new Exception('Колода не пренадлежит пользователю');
        }
        $deck = Deck::findOrFail($deckId);
        $deck->cards()->detach();
        $deck->delete();
    }

}
