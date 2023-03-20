<?php

namespace App\Voiceover;

abstract class VoiceoverAbstract
{

    abstract public static function newClient(string $text, string $pronunciation, string $announcer);

    abstract public function get(): string;
}
