<?php

namespace App\Http\Controllers\Client;

use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileTrackController extends Controller
{
    public function show(Track $track)
    {
        $requestsToJoin = $track->users_requests->where('action', 'send')->where('joining', true);
        $requestsToJoin = $this->filterNullableUser($requestsToJoin);

        $requestsToRefused = $track->users_requests->where('action', 'send')->where('refused', true);
        $requestsToRefused = $this->filterNullableUser($requestsToRefused);

        $users = $track->usersWithoutTrashed;
        return view('profile.track.teacher.show', compact('track', 'requestsToJoin', 'requestsToRefused', 'users'));
    }

    public function filterNullableUser($collection)
    {
        return $collection->filter(function($item) {
            return $item->user !== null;
        });
    }

    public function userShow(Track $track)
    {
        return view('profile.track.student.show', compact('track'));
    }
}
