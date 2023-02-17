<?php
namespace App\Queries\Deck;

use App\Models\Deck;

class thisDeckBelongsToTheUserQuery
{

    public static function check(int $userId, int $deckId): bool
    {
        $card = Deck::findOrFail($deckId)->first();
        if ($card->user_id == $userId) {
            return true;
        }
        return false;
    }

}
