<?php

namespace App\Http\Controllers;
use App\Translation\Translator;
class TranslatorController extends Controller
{

    public function translate(string $word)
    {
        return Translator::translate($word);
    }

}
