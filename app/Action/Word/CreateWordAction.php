<?php
namespace App\Action\Word;
use App\Models\Word;
use App\Translation\Translator;
class CreateWordAction{
        
    public static function execute(string $newWord) : Word
    {
        $translate = Translator::translate($newWord);
        $word = new Word();
        $word->value = $newWord;
        $word->data = json_encode($translate);
        $word->save();
        return $word;
    }    
        
}