<?php
namespace App\Action\User;

use App\Models\User;

class AddToTheBalanceAction
{

    public static function execute(int $id, int $value): User
    {
        $user = User::find($id);
        $user->balance = $user->balance + $value;
        $user->save();
        return $user;
    }

}
