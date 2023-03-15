<?php
namespace App\Verification\User;

use App\Models\User;

class CanBeWrittenOffFromTheBalance
{

    public static function check(int $id, int $value): bool
    {
        $user = User::find($id);
        if (($user->balance - $value) < 0) {
            return false;
        }
        return true;
    }
}
