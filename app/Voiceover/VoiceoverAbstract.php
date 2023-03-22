<?php

namespace App\Voiceover;

abstract class VoiceoverAbstract
{

    abstract public static function voice(string $text, string $pronunciation, string $announcer);

    abstract public function get(): string;
}
