<?php


namespace App\Service\User;


use App\Constants\HttpStatus;
use App\Models\User;
use App\Traits\GeneralTrait;

class UserService
{
    use GeneralTrait;

    public function setFollow($id): void
    {
        auth()->user()->follows()->sync($id);
    }

    public function getUser($id): User| null
    {
        return User::where('id',$id)->first();
    }

}
