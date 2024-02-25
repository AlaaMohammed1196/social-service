<?php

namespace App\Http\Controllers\Api;

use App\Constants\HttpStatus;
use App\Http\Controllers\Controller;
use App\Service\Auth\AuthService;
use App\Http\Requests\{
    AuthRequest,
    RegisterRequest
};

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Traits\{
    GeneralTrait,
    UploadMedia

};

class AuthController extends Controller
{
    use GeneralTrait, UploadMedia;

    private  AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService=$authService;
    }

    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = $this->authService->login($credentials);
        if (!$token)
            return $this->returnError('Incorrect Email or password', HttpStatus::AUTHENTICATION_FAILURE);

            $data = $this->authService->createToken($token);
            $data['user'] = new UserResource(auth('api')->user());
            return $this->returnDate('items', $data, 'User Login Successfully');

    }

    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $registerRequest['password'] = Hash::make($registerRequest->password);
        $user=$this->authService->register($registerRequest->all());
        $this->uploadFile($user , $registerRequest->image, 'user');

        return $this->returnSuccessMessage('User Register Successfully');
    }

}
