<?php
namespace App\Queries\User;

use App\Models\User;

class GetUserQuery 
{

    public static function find(int $id): User
    {
        return User::findOrFail($id)->first();
    }

}
