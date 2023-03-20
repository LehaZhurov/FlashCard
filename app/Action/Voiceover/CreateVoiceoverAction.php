<?php
namespace App\Action\Voiceover;

use App\Voiceover\Voiceover;

class CreateVoiceoverAction
{

    public static function execute(string $word): string
    {
        // $filename = $word . '.mp3';
        $fileUrl = Voiceover::newClient($word, 'British', 'Daniel')->get();
        // $filePath = storage_path('app/public/'.$filename);
        // $content = file_get_contents($fileUrl);
        // file_put_contents($filePath, $content);
        return $fileUrl;
    }

}
