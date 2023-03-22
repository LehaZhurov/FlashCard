<?php

namespace App\Http\Controllers;

use App\Action\Card\AddCardToDeckAction;
use App\Action\Card\CreateCardAction;
use App\Action\Card\RemoveCardFromDeckAction;
use App\Action\Card\SprayCardAction;
use App\Http\Requests\Card\AddCardToDeckRequest;
use App\Http\Requests\Card\CreateCardRequest;
use App\Http\Requests\Card\RemoveCardFromDeckRequest;
use App\Http\Resources\Card\CardPaginationResource;
use App\Http\Resources\Card\CardResource;
use App\Http\Resources\EmptyResource;
use App\Queries\Card\GetCardsUserQuery;
use Auth;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CardController extends Controller
{

    public function create(CreateCardRequest $request): CardResource
    {
        $requestCollection = $request->collect();
        $requestCollection->put('user_id', Auth::id());
        $card = CreateCardAction::execute($requestCollection);
        return new CardResource($card);
    }

    public function getCards(): CardPaginationResource
    {
        $cards = GetCardsUserQuery::find(Auth::id(), 25);
        return new CardPaginationResource($cards);
    }

    public function delete(int $cardId): EmptyResource
    {
        SprayCardAction::execute(Auth::id(), $cardId);
        return new EmptyResource();
    }

    public function addCardToDeck(AddCardToDeckRequest $request): AnonymousResourceCollection
    {
        $requestCollection = $request->collect();
        $requestCollection->put('user_id', Auth::id());
        $cardsDeck = AddCardToDeckAction::execute($requestCollection);
        return CardResource::collection($cardsDeck);
    }

    public function removeCardFromDeck(RemoveCardFromDeckRequest $request): EmptyResource
    {
        $requestCollection = $request->collect();
        $requestCollection->put('user_id', Auth::id());
        $cardsDeck = RemoveCardFromDeckAction::execute($requestCollection);
        return new EmptyResource();
    }
}
