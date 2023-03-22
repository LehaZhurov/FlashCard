<?php
namespace App\Verification\Deck;

use App\Models\Deck;

class ThisDeckBelongsToTheUser
{

    public static function check(Deck $deck, $userId): bool
    {
        if ($deck->user_id == $userId) {
            return true;
        }
        return false;
    }

}
