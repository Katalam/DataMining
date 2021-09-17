<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Utilities\ProfileHelper;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $profile = ProfileHelper::getUpdatedProfile($profile);
        return view('uprofile.show', compact('profile'));
    }

    public function search(Request $request)
    {
        $profile = ProfileHelper::getUpdatedProfile($request->username);
        $remaining = $profile[1];
        $profile = $profile[0];
        if ($profile === null)
        {
            return redirect(route('dashboard'))->with('status', 'Username not found');
        }
        return redirect(route('uprofile.show', [ 'profile' => $profile ]));
    }

    public function statistic()
    {
        $profiles_downloads = Profile::orderByDesc('downloads')->take(10)->get();
        $profiles_views = Profile::orderByDesc('total_views')->take(10)->get();
        return view('uprofile.statistic', compact('profiles_downloads', 'profiles_views'));
    }
}
