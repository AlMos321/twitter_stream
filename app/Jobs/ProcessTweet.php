<?php

namespace App\Jobs;

use App\Tweet;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessTweet implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $tweet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tweet = json_decode($this->tweet,true);
        $tweetText = isset($tweet['text']) ? $tweet['text'] : null;
        $userId = isset($tweet['user']['id_str']) ? $tweet['user']['id_str'] : null;
        $userScreenName = isset($tweet['user']['screen_name']) ? $tweet['user']['screen_name'] : null;
        $userAvatarUrl = isset($tweet['user']['profile_image_url_https']) ? $tweet['user']['profile_image_url_https'] : null;
        $mediaUrl = isset($tweet['entities']['media'][0]['media_url']) ? $tweet['entities']['media'][0]['media_url'] : null;
        $allApproved = env('ALL_TWEETS_APPROVED', '');


        if (isset($tweet['id'])) {
            Tweet::create([
                'id_str' => $tweet['id_str'],
                'json' => $this->tweet,
                'tweet_text' => $tweetText,
                'user_id' => $userId,
                'user_screen_name' => $userScreenName,
                'user_avatar_url' => $userAvatarUrl,
                'media_url' => $mediaUrl,
                'approved' => $allApproved
            ]);
        }
    }
}
