<?php

namespace App\Http\Controllers;

use App\Http\Requests\Deck\DeckRequest;

class DeckController extends Controller
{
    public function create(DeckRequest $request)
    {
        $name = $request->get('name');
    }
}
