<?php
namespace App\Queries\Deck;

use App\Models\Deck;

class thisDeckBelongsToTheUserQuery
{

    public static function check(int $userId, int $deck): bool
    {
        $card = Deck::findOrFail($deck)->first();
        if ($card->user_id == $userId) {
            return true;
        }
        return false;
    }

}
