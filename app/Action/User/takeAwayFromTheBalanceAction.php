<?php
namespace App\Action\User;

use App\Models\User;

class takeAwayFromTheBalanceAction
{

    public static function execute(int $id, int $value): User
    {
        $user = User::findOrFail($id);
        $user->balance = $user->balance - $value;
        $user->save();
        return $user;
    }

}
