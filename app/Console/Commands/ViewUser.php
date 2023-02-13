<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ViewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:view';

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
        $users = User::get();
        foreach ($users as $user) {
            echo $user->id.")".$user->name.PHP_EOL;
        }
    }
}
