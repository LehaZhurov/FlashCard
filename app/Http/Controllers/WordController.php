<?php

namespace App\Http\Controllers;

use App\Action\Word\CreateWordAction;
use App\Action\Word\IsThereSuchWordAction;
use App\Action\Word\SearchWordAction;
use App\Http\Requests\Word\CreateWordRequest;
use App\Http\Resources\Word\WordResource;

class WordController extends Controller
{

    public function create(CreateWordRequest $request): WordResource
    {
        $word = $request->get('word');
        if (IsThereSuchWordAction::execute($word)) {
            $newWord = CreateWordAction::execute($word);
            return new WordResource($newWord);
        }
        $word = SearchWordAction::execute($word);
        return new WordResource($word);
    }

}
