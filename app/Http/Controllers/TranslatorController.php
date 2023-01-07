<?php

namespace App\Http\Controllers;
use App\Translation\Translator;
class TranslatorController extends Controller
{

    public function search(string $name)
    {
        return Translator::translate($name);
    }

}
