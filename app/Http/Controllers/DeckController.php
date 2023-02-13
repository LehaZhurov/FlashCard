<?php

namespace App\Http\Controllers;

use App\Action\Deck\CreateDeckAction;
use App\Action\Deck\DeleteDeckAction;
use App\Http\Requests\Deck\DeckRequest;
use App\Http\Resources\Deck\DeckPaginationResource;
use App\Http\Resources\Deck\DeckResource;
use App\Http\Resources\EmptyResource;
use App\Queries\Deck\getDecksUserQuery;
use Auth;

class DeckController extends Controller
{
    public function create(DeckRequest $request)
    {
        $name = $request->get('name');
        $deck = CreateDeckAction::execute($name, Auth::id());
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
        DeleteDeckAction::execute($userId,$deckId);
        return new EmptyResource();
    }
}
