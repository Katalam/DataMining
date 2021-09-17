<?php

namespace App\Utilities;

use Carbon\Carbon;
use UnsplashUsers;
use App\Models\Picture;
use App\Models\Profile;

class ProfileHelper
{
    private static $updateDiff = 12; // hours

    public static function getUpdatedProfile($username)
    {
        $profile = $username;
        if (is_string($username))
        {
            $profile = Profile::where('username', '=', $username)->first();
        }
        else
        {
            $username = $profile->username;
        }
        if ($profile === null || $profile->updated_at->diffInHours(Carbon::now()) > self::$updateDiff) {
            $photos = UnsplashUsers::photos($username, [ 'stats' => true, 'per_page' => 5000 ]);
            $user = null;
            if ($photos === [] || $photos === null)
            {
                $user = UnsplashUsers::profile($username, []);
            }
            else
            {
                $user = $photos[0]['user'];
            }

            foreach ($photos as $photo) {
                Picture::updateOrCreate([ 'id' => $photo['id'] ], [
                    'id' => $photo['id'],
                    'profile_id' => $user['id'],
                    'description' => $photo['description'],
                    'url' => $photo['urls']['raw'],
                    'total_likes' => $photo['statistics']['likes']['total'],
                    'total_downloads' => $photo['statistics']['downloads']['total'],
                    'total_views' => $photo['statistics']['views']['total'],
                    'created_external' => date('Y-m-d H:i:s.uZ', strtotime($photo['created_at'])),
                ]);
            }

            $statistic = UnsplashUsers::statistics($username, []);

            $profile = Profile::updateOrCreate([ 'id' => $user['id'] ], [
                'id' => $user['id'],
                'username' => $user['username'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'twitter_username' => $user['twitter_username'],
                'portfolio_url' => $user['portfolio_url'],
                'bio' => $user['bio'],
                'location' => $user['location'],
                'instagram_username' => $user['instagram_username'],
                'profile_image' => strtok($user['profile_image']['large'], '?'),
                'total_collections' => $user['total_collections'],
                'total_likes' => $user['total_likes'],
                'total_views' => $statistic['views']['total'],
                'for_hire' => $user['for_hire'],
                'paypal_email' => $user['social']['paypal_email'],
                'followers_count' => $user['followers_count'],
                'following_count' => $user['following_count'],
                'allow_messages' => $user['allow_messages'],
                'numeric_id' => $user['numeric_id'],
                'downloads' => $user['downloads'],
                'updated_external' => date('Y-m-d H:i:s.uZ', strtotime($user['updated_at'])),
            ]);
        }
        return $profile;
    }
}
