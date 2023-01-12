<?php

namespace App\Http\Controllers;
use App\Translation\Translator;
use App\Action\Word\IsThereSuchWordAction;
use App\Action\Word\SearchWordAction;

class TranslatorController extends Controller
{

    public function translate(string $word)
    {
        if (IsThereSuchWordAction::execute($word)) {
            return Translator::translate($word);
        }

        return SearchWordAction::execute($word)->data;
    }

}
