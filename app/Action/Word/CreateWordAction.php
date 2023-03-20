<?php
namespace App\Action\Word;

use App\Models\Word;
use App\Translation\Translator;

class CreateWordAction
{

    public static function execute(string $newWord): Word
    {
        $translate = Translator::translate($newWord);
        $word = new Word();
        $word->value = preg_replace('/\s+/', '_', $newWord);
        $word->data = json_encode($translate);
        $word->audio = 'def';
        $word->save();
        return $word;
    }

}
