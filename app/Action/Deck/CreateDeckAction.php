<?php
namespace App\Action\Deck;

use App\Models\Deck;

class CreateDeckAction
{

    public static function execute(int $userId, string $name): Deck
    {
        $deck = new Deck();
        $deck->name = $name;
        $deck->user_id = $userId;
        $deck->save();
        return $deck;
    }

}
