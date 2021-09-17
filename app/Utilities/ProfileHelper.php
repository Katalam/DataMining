<?php

namespace App\Utilities;

use Carbon\Carbon;
use UnsplashUsers;
use App\Models\Picture;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;

class ProfileHelper
{
    private static $updateDiff = 12; // hours

    private static $rules = [
        'id' => 'required',
        'username' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'twitter_username' => 'present',
        'portfolio_url' => 'present',
        'bio' => 'present',
        'location' => 'present',
        'instagram_username' => 'present',
        'profile_image' => 'present',
        'total_collections' => 'numeric',
        'total_likes' => 'numeric',
        'total_photos' => 'numeric',
        'for_hire' => 'boolean',
        'social.paypal_email' => 'present',
        'followers_count' => 'numeric',
        'following_count' => 'numeric',
        'allow_messages' => 'boolean',
        'numeric_id' => 'numeric',
        'downloads' => 'numeric',
        'updated_at' => 'date',
    ];

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

            // User statistic
            $statistic = UnsplashUsers::statistics($username, []);

            // User
            $validator = Validator::make($user, self::$rules);
            if ($validator->fails()) {
                return null;
            }
            $user = $validator->validated();

            // Fix paypal_email only listed in social array
            $user['paypal_email'] = $user['social']['paypal_email'];
            unset($user['social']);

            // Fix profile_image url
            $user['profile_image'] = strtok($user['profile_image']['large'], '?');

            // Rename updated_at from unsplash API to updated_external
            $user['updated_external'] = date('Y-m-d H:i:s.uZ', strtotime($user['updated_at']));

            // copy total views from statistic to user
            $user['total_views'] = $statistic['views']['total'];

            $profile = Profile::updateOrCreate([ 'id' => $user['id'] ], $user);
        }
        return $profile;
    }
}
