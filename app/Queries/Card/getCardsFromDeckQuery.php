<?php
namespace App\Queries\Card;

use App\Models\Deck;
use App\Verification\Deck\ThisDeckBelongsToTheUser;
use Illuminate\Support\Collection;

class GetCardsFromDeckQuery
{

    public static function find(int $userId, int $deckId): Collection
    {
        $deck = Deck::findOrFail($deckId);
        if (!ThisDeckBelongsToTheUser::check($deck, $userId)) {
            throw new Exception('Колода(' . $deckId . ') не пренадлежит пользователю(' . $deckId . ')');
        }
        $deck = Deck::findOrFail($deckId)
            ->cards()
            ->join('words', 'words.id', '=', 'cards.word_id')
            ->select(
                'cards.id', 'cards.level', 'cards.url',
                'cards.user_id', 'cards.created_at', 'cards.repeats',
                'words.value', 'words.data' , 'words.audio'
            )
            ->orderBy('cards.id', 'DESC')
            ->get();
        
        $deck = $deck->map(function ($item, $key) use ($deckId) {
            $item['deck_id'] = $deckId;
            return $item;
        });
        
        return $deck;
    }

}
