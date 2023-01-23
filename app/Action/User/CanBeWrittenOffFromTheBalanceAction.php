<?php
namespace App\Action\User;
use App\Models\User;
class CanBeWrittenOffFromTheBalanceAction{
        
    public static function execute(int $id, int $value): bool
    {
        $user = User::find($id);
        if(($user->balance - $value) < 0){
            return false;
        }
        return true;
    } 
}