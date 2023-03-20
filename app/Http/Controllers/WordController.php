<?php

namespace App\Http\Controllers;

use App\Action\Voiceover\CreateVoiceoverAction;
use App\Action\Word\CreateWordAction;
use App\Http\Requests\Word\CreateWordRequest;
use App\Http\Resources\Word\WordResource;
use App\Queries\Word\SearchWordQuery;
use App\Verification\Word\AddAudioWordAction;
use App\Verification\Word\IsThereSuchWord;

class WordController extends Controller
{

    public function create(CreateWordRequest $request): WordResource
    {
        $word = $request->get('word');
        if (IsThereSuchWord::check($word)) {
            $newWord = CreateWordAction::execute($word);
            return new WordResource($newWord);
        }
        $word = SearchWordQuery::execute($word);
        return new WordResource($word);
    }

    public function createAudioWord(CreateWordAction $action)
    {
        $word = $request->get('word');
        $path = CreateVoiceoverAction::execute($word);
        $word = AddAudioWordAction::execute($word, $path);
        return new WordResource($word);
    }
}
