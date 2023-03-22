<?php
namespace App\Verification\Card;

use App\Models\Card;

class ThisCardBelongsToTheUser
{

    public static function check(Card $card, int $userId): bool
    {
        if ($card->user_id == $userId) {
            return true;
        }
        return false;
    }

}
