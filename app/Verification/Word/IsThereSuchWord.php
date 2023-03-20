<?php
namespace App\Verification\Word;

use App\Models\Word;

class IsThereSuchWord
{

    public static function check(string $newWord): bool
    {
        $newWord = preg_replace('/\s+/', '_', $newWord);
        $word = Word::query()->where('value', '=', $newWord);
        if ($word->exists()) {
            return false;
        }
        return true;
    }

}
