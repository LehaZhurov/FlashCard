<?php

namespace App\Http\Controllers;

use App\Action\Card\AddCardToDeckAction;
use App\Action\Card\CreateCardAction;
use App\Action\Card\sprayCardAction;
use App\Http\Requests\Card\AddCardToDeckRequest;
use App\Http\Requests\Card\CreateCardRequest;
use App\Http\Resources\Card\CardPaginationResource;
use App\Http\Resources\Card\CardResource;
use App\Http\Resources\EmptyResource;
use App\Queries\Card\getCardsUserQuery;
use Auth;
use Illuminate\Http\Response;

class CardController extends Controller
{

    public function create(CreateCardRequest $request): CardResource | Response
    {
        $requestCollection = $request->collect();
        $requestCollection->put('user_id', Auth::id());
        $card = CreateCardAction::execute($requestCollection);
        return new CardResource($card);
    }

    public function getCards(): CardPaginationResource
    {
        $cards = getCardsUserQuery::find(Auth::id(), 25);
        return new CardPaginationResource($cards);
    }

    public function delete(int $cardId): EmptyResource
    {
        sprayCardAction::execute(Auth::id(), $сardId);
        return new EmptyResource();
    }

    public function addCardToDeck(AddCardToDeckRequest $request): CardResource
    {
        $requestCollection = $request->collect();
        $requestCollection->put('user_id', Auth::id());
        $cardsDeck = AddCardToDeckAction::execute($requestCollection);
        return CardResource::collection($cardsDeck);
    }
}
