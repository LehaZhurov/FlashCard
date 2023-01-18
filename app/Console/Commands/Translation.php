<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Translation\Translator;
class Translation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deepl:translation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'перевод через консоль';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $word = readline("Слово:");
        var_dump(Translator::translate($word));
        return $this->handle();
    }
}
