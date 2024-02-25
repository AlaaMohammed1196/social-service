<?php


namespace App\Service\Tweet;
use App\Constants\App;
use App\Models\Tweet;
class TweetService
{
         public function store($data=[]) :Tweet
         {
             return Tweet::create($data);
         }

         public function getTimeLine()
         {
             return Tweet::wherein('id',auth()->user()->followingIds())->paginate(App::PAGINATE_LENGTH);
         }


}
