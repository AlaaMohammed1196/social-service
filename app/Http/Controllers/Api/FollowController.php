<?php

namespace App\Http\Controllers\Api;

use App\Constants\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Service\User\UserService;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
    use GeneralTrait;

    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function follow(Request $request): JsonResponse
    {
        $user = $this->userService->getUser($request->only('following_user_id'));
        if(!$user)
            return  $this->returnError('User Id Isn\'t Correct',HttpStatus::BAD_REQUEST);

                $this->userService->setFollow($request->only('following_user_id'));
        return $this->returnSuccessMessage('Follow Successfully');
    }

}
