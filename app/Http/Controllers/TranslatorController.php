<?php

namespace App\Http\Controllers;

use App\Verification\Word\IsThereSuchWord;
use App\Action\Word\SearchWordAction;
use App\Translation\Translator;
use stdClass;

class TranslatorController extends Controller
{

    public function translate(string $word): array | stdClass
    {
        if (IsThereSuchWord::check($word)) {
            return Translator::translate($word);
        }

        return json_decode(SearchWordAction::execute($word)->data);
    }

}
