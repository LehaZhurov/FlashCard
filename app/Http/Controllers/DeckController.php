<?php

namespace App\Http\Controllers;

use App\Action\Deck\CreateDeckAction;
use App\Action\Deck\DeleteDeckAction;
use App\Http\Requests\Deck\DeckRequest;
use App\Http\Resources\Card\CardResource;
use App\Http\Resources\Deck\DeckPaginationResource;
use App\Http\Resources\Deck\DeckResource;
use App\Http\Resources\EmptyResource;
use App\Queries\Card\getCardsFromDeckQuery;
use App\Queries\Deck\getDecksUserQuery;
use Auth;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DeckController extends Controller
{
    public function create(DeckRequest $request)
    {
        $name = $request->get('name');
        $userId = Auth::id();
        $deck = CreateDeckAction::execute($userId, $name);
        return new DeckResource($deck);
    }

    public function getDecks(): DeckPaginationResource
    {
        $userId = Auth::id();
        $cards = getDecksUserQuery::find($userId, 25);
        return new DeckPaginationResource($cards);
    }

    public function delete($deckId)
    {
        $userId = Auth::id();
        DeleteDeckAction::execute($userId, $deckId);
        return new EmptyResource();
    }

    public function getCards($deckId): AnonymousResourceCollection
    {
        $userId = Auth::id();
        $cards = getCardsFromDeckQuery::find($userId, $deckId);
        return CardResource::collection($cards);
    }
}
