<?php


namespace App\Service\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Constants\App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthService
{
    public function createToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth(App::API_GUARD)->factory()->getTTL() * App::EXPIRATION_TIME,
        ];
    }

    public function login($credentials): string
    {
        return auth(App::API_GUARD)->attempt($credentials);
    }

    public function register($userData)
    {
        return User::create($userData);

    }

}
