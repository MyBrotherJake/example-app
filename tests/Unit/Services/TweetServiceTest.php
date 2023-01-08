<?php

namespace Tests\Unit\Services;

use Mockery;
use PHPUnit\Framework\TestCase;
use App\Services\TweetService;
use App\Modules\ImageUpload\ImageManagerInterface;

class TweetServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     * @runInSeparateProcess
     * @return void
     */
    public function test_check_own_tweet()
    {
        $imageManager = Mockery::mock(ImageManagerInterface::class);
        $tweetService = new TweetService($imageManager);

        // Mock
        $mock = Mockery::mock('alias:App\Models\Tweet');
        $mock->shouldReceive('where->first')->andReturn((object)[
            'id' => 1,
            'user_id' => 1
        ]);

        $result = $tweetService->checkOwnTweet(1, 1);
        $this->assertTrue(true);

        $result = $tweetService->checkOwnTweet(2, 1);
        $this->assertFalse($result);
    }
}
