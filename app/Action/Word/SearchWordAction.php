<?php
namespace App\Action\Word;

use App\Models\Word;

class SearchWordAction
{

    public static function execute(string $word): Word
    {
        $word = preg_replace('/\s+/', '_', $word);
        return Word::where('value', '=', $word)->get()->first();

    }

}
