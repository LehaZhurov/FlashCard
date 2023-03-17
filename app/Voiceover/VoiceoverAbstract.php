<?php

namespace App\Voiceover;

abstract class Voiceover
{

    abstract public function voice(string $text): string;

}
