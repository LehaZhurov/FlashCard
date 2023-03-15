<?php
namespace App\Verification\Deck;

use App\Models\Card;
use App\Models\Deck;

class ThisCardFromDeck
{

    public static function check(Deck $deck, Card $card): bool
    {
        foreach ($deck->cards as $item) {
            if ($item->id == $card->id) {
                return true;
            }
        }
        return false;
    }
}
