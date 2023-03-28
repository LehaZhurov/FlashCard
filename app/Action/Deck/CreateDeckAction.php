<?php
namespace App\Action\Deck;

use App\Models\Deck;
use App\Verification\Deck\CanUserCreateMoreDeck;
use Exception;

class CreateDeckAction
{

    public static function execute(int $userId, string $name): Deck
    {
        if (!CanUserCreateMoreDeck::check($userId)) {
            throw new Exception('Лимит колод исчерпан');
        }

        $deck = new Deck();
        $deck->name = $name;
        $deck->user_id = $userId;
        $deck->save();
        return $deck;
    }

}
