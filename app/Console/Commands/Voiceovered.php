<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Voiceover\Voiceover;

class Voiceovered extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voiceover:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Озвучка текста';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $text = readline('Текст:');
        $src = Voiceover::newClient($text,'British','Malcolm')->get();
        echo $src.PHP_EOL;
    }
}
