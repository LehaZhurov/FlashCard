<?php

namespace App\Http\Controllers;

use App\Action\Card\CreateCardAction;
use App\Action\User\CanBeWrittenOffFromTheBalanceAction;
use App\Action\User\takeAwayFromTheBalanceUserAction;
use App\Http\Requests\Card\CreateCardRequest;
use App\Http\Resources\Card\CardPaginationResource;
use App\Http\Resources\Card\CardResource;
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
            return response(['error' => 'Не достаточно пыли'], 401);
        }
        $request = $request->all();
        $card = CreateCardAction::execute($request['word'], $request['gif'], $userId);
        takeAwayFromTheBalanceUserAction::execute($userId, $this->cardPrice);
        return new CardResource($card);
    }

    public function getCards(): CardPaginationResource
    {
        $cards = getCardsUserQuery::find();
        return new CardPaginationResource($cards);
    }
}
