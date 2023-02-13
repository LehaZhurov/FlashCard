<?php

namespace App\Console\Commands;

use App\Action\User\addToTheBalanceAction;
use Illuminate\Console\Command;

class addToTheBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:topUpBalance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = readline('user_id:');
        $dust = readline('dustCount:');
        addToTheBalanceAction::execute((int) $userId, (int) $dust);
        echo "Баланс пользователя(".$userId.") на".$userId.PHP_EOL;
    }
}
