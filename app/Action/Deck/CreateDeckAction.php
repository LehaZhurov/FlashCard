<?php
namespace App\Action\Deck;

use App\Models\Deck;

class CreateDeckAction
{

    public static function execute(string $name, int $userId): Deck
    {
        $deck = new Deck();
        $deck->name = $name;
        $deck->user_id = $userId;
        $deck->save();
        return $deck;
    }

}
