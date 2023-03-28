<?php
namespace App\Action\Voiceover;

use App\Voiceover\Voiceover;

class CreateVoiceoverAction
{

    public static function execute(string $word): string
    {
        $fileUrl = Voiceover::voice($word, 'British', 'Malcolm')->get();
        return $fileUrl;
    }

}
