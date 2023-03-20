<?php
namespace App\Action\Word;

use App\Queries\Word\SearchWordQuery;

class AddAudioWordAction
{

    public static function execute(string $word, string $src): Word
    {
        $word = SearchWordQuery::execute($word);
        $word->audio = $src;
        $word->save();
        return $word;
    }

}
