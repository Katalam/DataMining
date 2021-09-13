<?php

namespace App\Utilities;

use Carbon\Carbon;
use UnsplashUsers;
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
        'twitter_username' => 'required',
        'portfolio_url' => 'required',
        'bio' => 'required',
        'location' => 'nullable', // default is missing in migration
        'instagram_username' => 'required',
    ];

    public static function getUpdatedProfile($username)
    {
        $profile = Profile::where('username', '=', $username)->first();
        if ($profile === null || $profile->updated_at->diffInHours(Carbon::now()) > self::$updateDiff) {
            $user = UnsplashUsers::profile($username, []);
            $user = json_decode($user->getContents(), true);
            $validator = Validator::make($user, self::$rules);
            if ($validator->fails()) {
                return null;
            }
            $user = $validator->validated();
            $profile = Profile::updateOrCreate($user, $user);
        }
        return $profile;
    }
}
