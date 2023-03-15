<?php
namespace App\Verification\Deck;

use App\Models\Deck;

class thisDeckBelongsToTheUser
{

    public static function check(Deck $deck, int $userId): bool
    {
        if ($deck->user_id == $userId) {
            return true;
        }
        return false;
    }

}
