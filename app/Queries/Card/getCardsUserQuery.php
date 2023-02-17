<?php
namespace App\Queries\Card;

use App\Models\Card;
use App\Pagination\Paginator;
use Illuminate\Support\Collection;

class getCardsUserQuery
{

    public static function find(int $userId, int $limit = 25): Collection
    {
        $cardsUserQuery =
        Card::query()
            ->where('user_id', $userId)
            ->RightJoin('words', 'words.id', '=', 'cards.word_id')
            ->select(
                'cards.id', 'cards.level', 'cards.url',
                'cards.user_id', 'cards.created_at', 'cards.repeats',
                'words.value', 'words.data'
            )
            ->orderBy('cards.id', 'DESC');
        $cardsUser = Paginator::build($cardsUserQuery, $limit);
        return $cardsUser;
    }

}
