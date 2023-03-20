<?php
namespace App\Action\Voiceover;

use App\Voiceover\Voiceover;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CreateVoiceoverAction
{

    public static function execute(string $word): string
    {
        $fileUrl = Voiceover::newClient($word, 'British', 'Kate')->get();
        $fileName = $word . ".mp3";
        $contents = file_get_contents($fileUrl);
        $file = new File(public_path('voiceover/' . $fileName));
        $file->put($contents);
        Storage::disk('local')->put($fileName, $file);
        $fileName;
    }

}
