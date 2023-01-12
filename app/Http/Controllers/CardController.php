<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action\Card\CreateCardAction;
use App\Http\Requests\Card\CreateCardRequest;
use App\Http\Resources\Card\CardResource;

class CardController extends Controller
{
    public function create(CreateCardRequest $request){
        $request = $request->all();
        $card = CreateCardAction::execute($request['word'],$request['gif']);
        return new CardResource($card);
    }
}
