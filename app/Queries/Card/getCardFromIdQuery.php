<?php
namespace App\Queries\Card;

use App\Models\Card;

class getCardFromIdQuery
{

    public static function find(int $id): Card
    {
        $card = Card::findOrFail($id)
            ->RightJoin('words', 'words.id', '=', 'cards.word_id')
            ->select(
                'cards.id', 'cards.level', 'cards.url',
                'cards.user_id', 'cards.created_at', 'cards.repeats',
                'words.value', 'words.data'
            )
            ->orderBy('cards.id', 'DESC')
            ->get()
            ->first();
        return $card;
    }

}
