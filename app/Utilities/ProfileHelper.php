<?php

namespace App\Utilities;

use Carbon\Carbon;
use UnsplashUsers;
use App\Models\Picture;
use App\Models\Profile;

class ProfileHelper
{
    private static $updateDiff = 12; // hours
    private static $maxPhotosPerPage = 30; // given from unsplash

    public static function getUpdatedProfile($username)
    {
        $profile = $username;
        if (is_string($username)) {
            $profile = Profile::where('username', '=', $username)->first();
        } else {
            $username = $profile->username;
        }
        if ($profile === null || $profile->updated_at->diffInHours(Carbon::now()) > self::$updateDiff) {
            // popular == likes
            $photos = UnsplashUsers::photos($username, ['stats' => true, 'per_page' => self::$maxPhotosPerPage, 'order_by' => 'popular']);
            $user = UnsplashUsers::profile($username, []);
            if ($user == null)
                return null;

            if ($photos != null)
                self::savePictures($photos, $user['id']);

            if ($user['total_photos'] > self::$maxPhotosPerPage) {
                // more than 3 request needed
                // so we take only the first 30 photos for each category to minimise API calls
                if ($user['total_photos'] > (self::$maxPhotosPerPage * 3)) {
                    $photos = UnsplashUsers::photos($username, ['stats' => true, 'per_page' => 30, 'order_by' => 'downloads']);
                    self::savePictures($photos, $user['id']);
                    $photos = UnsplashUsers::photos($username, ['stats' => true, 'per_page' => 30, 'order_by' => 'views']);
                    self::savePictures($photos, $user['id']);
                } else { // less than 3 request needed
                    $i = 2;
                    $photos = UnsplashUsers::photos($username, ['stats' => true, 'per_page' => 30, 'page' => $i]);
                    while ($photos != []) {
                        self::savePictures($photos, $user['id']);
                        $i++;
                        $photos = UnsplashUsers::photos($username, ['stats' => true, 'per_page' => 30, 'page' => $i]);
                    }
                }
            }

            $statistic = UnsplashUsers::statistics($username, []);
            if ($statistic == null)
                return null;

            $profile = Profile::updateOrCreate(['id' => $user['id']], [
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

    private static function savePictures($photos, $userId)
    {
        foreach ($photos as $photo) {
            Picture::updateOrCreate(['id' => $photo['id']], [
                'id' => $photo['id'],
                'profile_id' => $userId,
                'description' => $photo['description'],
                'url' => $photo['urls']['raw'],
                'total_likes' => $photo['statistics']['likes']['total'],
                'total_downloads' => $photo['statistics']['downloads']['total'],
                'total_views' => $photo['statistics']['views']['total'],
                'created_external' => date('Y-m-d H:i:s.uZ', strtotime($photo['created_at'])),
            ]);
        }
    }
}
