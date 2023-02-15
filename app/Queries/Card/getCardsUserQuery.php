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
            ->join('words', 'words.id', '=', 'cards.word_id');
        $cardsUser = Paginator::build($cardsUserQuery, $limit);
        return $cardsUser;
    }

}
