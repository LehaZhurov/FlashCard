<?php
namespace App\Action\Word;
use App\Models\Word;
class IsThereSuchWordAction{
        
    public static function execute(string $newWord) : bool 
    {
        $newWord = preg_replace('/\s+/', '_', $newWord);
        $word = Word::query()->where('value', '=', $newWord);
        if($word->exists()){
            return false;
        }
        return true;
    }    
        
}