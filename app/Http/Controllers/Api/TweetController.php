<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\TweetResource;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Service\Tweet\TweetService;
use Illuminate\Http\JsonResponse;

class TweetController extends Controller
{
    use GeneralTrait;

    private TweetService $tweetService;
    public function __construct(TweetService $tweetService)
    {
        $this->tweetService=$tweetService;
    }

    public function store(TweetRequest $tweetRequest):JsonResponse
    {
        $tweetRequest['user_id']=auth()->user()->id;
       $this->tweetService->store($tweetRequest->all());
        return $this->returnSuccessMessage('Tweet Created Successfully');

    }

   public function timeLine(): JsonResponse
   {

       $tweets = $this->tweetService->getTimeLine();

      return $this->returnDateWithPaginate('items',$tweets,'tweets',TweetResource::class);
   }

}
