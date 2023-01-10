<?php
namespace App\Action\Word;

use App\Models\Word;

class SearchWordAction
{

    public static function execute(string $word): Word
    {
        return Word::where('value','=',$word)->first();
    }

}
