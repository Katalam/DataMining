<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Utilities\ProfileHelper;
use UnsplashPhotos;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $profile = ProfileHelper::getUpdatedProfile($profile);
        $pictures = $profile->pictures()->orderByDesc('created_external')->take(5)->get();
        return view('uprofile.show', compact('profile', 'pictures'));
    }

    public function search(Request $request)
    {
        $username = $request->username;
        $output = null;
        preg_match('/https?:\/\/unsplash.com\/@/', $username, $output);
        if (count($output) > 0) {
            $username = str_replace($output[0], '', $username);
        }

        $profile = ProfileHelper::getUpdatedProfile($username);
        if ($profile === null) {

            $photo = UnsplashPhotos::single($username, []);
            if ($photo == null) {
                return redirect(route('dashboard'))->with('status', 'Username or photo id not found or API limit reached');
            }
            $profile = ProfileHelper::getUpdatedProfile($photo['user']['username']);
        }
        return redirect(route('uprofile.show', ['profile' => $profile]));
    }

    public function statistic()
    {
        $profiles_downloads = Profile::orderByDesc('downloads')->take(10)->get();
        $profiles_views = Profile::orderByDesc('total_views')->take(10)->get();
        $profiles_likes = Profile::orderByDesc('total_likes')->take(10)->get();
        $pictures_likes = Picture::orderByDesc('total_likes')->with('profile')->take(10)->get();
        $pictures_views = Picture::orderByDesc('total_views')->with('profile')->take(10)->get();
        $pictures_downloads = Picture::orderByDesc('total_downloads')->with('profile')->take(10)->get();
        return view('uprofile.statistic', compact('profiles_downloads', 'profiles_views', 'profiles_likes', 'pictures_likes', 'pictures_views', 'pictures_downloads'));
    }
}
