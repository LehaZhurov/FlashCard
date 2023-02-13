<?php
namespace App\Queries\Card;

use App\Models\Card;

class thisCardBelongsToTheUserQuery
{

    public static function check(int $userId, int $cardId): bool {
        $card = Card::findOrFail($cardId)->first();
        if ($card->user_id == $userId) {
            return true;
        }
        return false;
    }

}
