<?php
namespace App\Queries\Deck;

use App\Models\Deck;
use App\Pagination\Paginator;
use Illuminate\Support\Collection;

class getDecksUserQuery
{

    public static function find(int $userId, int $limit = 25): Collection
    {
        $decksUserQuery = Deck::query()
            ->where('user_id', $userId);
        $decksUser = Paginator::build($decksUserQuery, $limit);
        return $decksUser;
    }

}
