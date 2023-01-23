<?php
namespace App\Queries\Card;

use App\Models\Card;

class getCardFromIdQuery
{

    public static function find(int $id): Card
    {
        $card = Card::find($id)
            ->join('words', 'words.id', '=', 'cards.word_id')
            ->get()->first();
        return $card;
    }

}
