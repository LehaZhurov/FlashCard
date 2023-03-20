<?php

namespace App\Http\Controllers;

use App\Verification\Word\IsThereSuchWord;
use App\Queries\Word\SearchWordQuery;
use App\Translation\Translator;
use stdClass;

class TranslatorController extends Controller
{

    public function translate(string $word): array | stdClass
    {
        if (IsThereSuchWord::check($word)) {
            return Translator::translate($word);
        }

        return json_decode(SearchWordQuery::execute($word)->data);
    }

}
