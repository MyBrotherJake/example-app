<?php

namespace App\Services;

use App\Models\Tweet;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Modules\ImageUpload\ImageManagerInterface;

class TweetService
{
  public function __construct(private ImageManagerInterface $imageManager)
  {

  }
  /**
   * Get
   */
  public function getTweets()
  {
    return Tweet::with('images')->orderBy('created_at', 'DESC')->get();
  }
  /**
   * Check
   */
  public function checkOwnTweet (int $userId, int $tweetId): bool
  {
    $tweet = Tweet::where('id', $tweetId)->first();
    if (! $tweet)
    {
      return false;
    }
    return $tweet->user_id === $userId;
  }
  /**
   * Tweet Count
   */
  public function countYesterdayTweets() :int
  {
    return Tweet::whereDate(
        'created_at', '>=',
        Carbon::yesterday()->toDateTimeString()
      )
      ->whereDate(
        'created_at', '<',
        Carbon::today()->toDateTimeString()
      )
      ->count();
  }  
  /**
   * Image
   */
  public function saveTweet(int $userId, string $content, array $images)
  {
    DB::transaction(function () use ($userId, $content, $images) {
      $tweet = new Tweet;
      $tweet->user_id = $userId;
      $tweet->content = $content;
      $tweet->save();
      foreach ($images as $image) {
        $name = $this->imageManager->save($imaage);
        //Storage::putFile('public/images', $image);
        $imageModel = new Image();
        $imageModel->name = $name;
        //$imageModel->name = $image->hashName();
        $imageModel->save();
        $tweet->images()->attach($imageModel->id);
      }
    });
  }
  public function deleteTweet(int $tweetId)
  {
    DB::transaction(function () use ($tweetId) {
      $tweet = Tweet::where('id', $tweetId)->firstOrFail();
      $tweet->images()->each(function ($image) use ($tweet) {
        /*
        $filePath = 'public/images/' . $image->name;
        if(Storage::exists($filePath)) {
          Storage::delete($filePath);
        }*/
        $this->imageManager->delete($image->name);
        $tweet->images()->detach($image->id);
        $image->delete();
      });
      $tweet->delete();
    });
  }
}