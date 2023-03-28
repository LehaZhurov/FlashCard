<?php
namespace App\Verification\Deck;

use App\Models\Deck;

class CanAddMoreCardInDeck
{
    public static $limit = 30;

    public static function check(Deck $deck): bool
    {
        $countCardsInDeck = $deck->cards()->count();
        if ($countCardsInDeck <= self::$limit) {
            return true;
        }
        return false;
    }
}
