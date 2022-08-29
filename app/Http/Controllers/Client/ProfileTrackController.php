<?php

namespace App\Http\Controllers\Client;

use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileTrackController extends Controller
{
    public function show(Track $track)
    {
        return view('profile.track.teacher.show', compact('track'));
    }

    public function userShow(Track $track)
    {
        return view('profile.track.student.show', compact('track'));
    }
}
