<?php

namespace App\Http\Controllers;

use App\Action\Card\AddCardToDeckAction;
use App\Action\Card\CreateCardAction;
use App\Action\Card\sprayCardAction;
use App\Action\User\CanBeWrittenOffFromTheBalanceAction;
use App\Action\User\takeAwayFromTheBalanceAction;
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
    private $cardPrice = 1000;

    public function create(CreateCardRequest $request): CardResource | Response
    {
        $userId = Auth::id();
        if (!CanBeWrittenOffFromTheBalanceAction::execute($userId, $this->cardPrice)) {
            throw new Exception('Не достаточно пыли');
        }
        $request = $request->all();
        $card = CreateCardAction::execute($request['word'], $request['gif'], $userId);
        takeAwayFromTheBalanceAction::execute($userId, $this->cardPrice);
        return new CardResource($card);
    }

    public function getCards(): CardPaginationResource
    {
        $userId = Auth::id();
        $cards = getCardsUserQuery::find($userId, 25);
        return new CardPaginationResource($cards);
    }

    public function delete(int $cardId)
    {
        $userId = Auth::id();
        sprayCardAction::execute($userId, $cardId);
        return new EmptyResource();
    }

    public function addCardToDeck(AddCardToDeckRequest $request)
    {
        $request = $request->all();
        $userId = Auth::id();
        $cardsDeck = AddCardToDeckAction::execute($request['card_id'], $request['deck_id'],$userId);
        return CardResource::collection($cardsDeck);
    }
}
