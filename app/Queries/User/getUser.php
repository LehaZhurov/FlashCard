<?php
namespace App\Queries\User;

use App\Models\User;

class getUser
{

    public static function find($id): User
    {
        return User::find($id)->first();
    }

}
