<?php
namespace App\Verification\Deck;

use App\Models\Deck;

class CanUserCreateMoreDeck
{
    public static $limit = 15;

    public static function check(int $userId): bool
    {
        $countDecksUser = Deck::where('user_id', $userId)->count();
        if ($countDecksUser <= self::$limit) {
            return true;
        }
        return false;
    }
}
