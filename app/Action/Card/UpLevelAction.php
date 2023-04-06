<?php
namespace App\Action\Card;

use App\Models\Card;


class UpLevelAction
{
    public static function execute(Card $card): Card
    {
        $cardRepeats = $card->repeats;
        if ($cardRepeats >= 10000 && $card->level == 3) {
            $card->level = 4;
        } elseif ($cardRepeats >= 5000 && $card->level == 2) {
            $card->level = 3;
        } elseif ($cardRepeats >= 2000 && $card->level == 1) {
            $card->level = 2;
        } else {
            $card->level = 1;
        }
        $card->save();
        return $card;
    }

}