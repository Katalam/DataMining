<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProfileHelper;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function show(Request $request)
    {
        $profile = ProfileHelper::getUpdatedProfile($request->username);
        if ($profile === null)
        {
            // Add error messages
            return view('dashboard');
        }
        return view('dashboard');
    }
}
