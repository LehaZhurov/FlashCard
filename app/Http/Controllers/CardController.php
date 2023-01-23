<?php

namespace App\Http\Controllers;

use App\Action\Card\CreateCardAction;
use App\Http\Requests\Card\CreateCardRequest;
use App\Http\Resources\Card\CardPaginationResource;
use App\Http\Resources\Card\CardResource;
use App\Queries\Card\getCardsUserQuery;

class CardController extends Controller
{
    public function create(CreateCardRequest $request): CardResource
    {
        $request = $request->all();
        $card = CreateCardAction::execute($request['word'], $request['gif']);
        return new CardResource($card);
    }

    public function getCards()
    {
        $cards = getCardsUserQuery::find();
        return new CardPaginationResource($cards);
    }
}
