<?php
namespace App\Queries\Word;

use App\Models\Word;

class SearchWordQuery
{

    public static function execute(string $word): Word
    {
        $word = preg_replace('/\s+/', '_', $word);
        return Word::where('value', '=', $word)->get()->first();
    }

}
