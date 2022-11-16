<?php

namespace App\Http\Controllers\Client;

use App\Models\Block;
use App\Models\User;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Models\TrackUserRequest;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tracks.index', ['tracks' => Track::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    
    public function show(Track $track)
    {
        $tracks = Track::all();
        $track_count = $track->count();
        if($track_count >= 3) {
            $tracks->random(3);
        }

        $requestToJoinSended = false;
        $requestToRefuseSended = false;

        if (isset(auth()->user()->tracks_requests)) {
            foreach (auth()->user()->tracks_requests as $trackRequest) {
                if ($track->id == $trackRequest->track_id && $trackRequest->joining) {
                    $requestToJoinSended = true;
                }
                if ($track->id == $trackRequest->track_id && $trackRequest->refused) {
                    $requestToRefuseSended = true;
                }
            }
        }
        $track = $track->load('blocks');



        return view('tracks.show', compact('track','tracks', 'requestToJoinSended', 'requestToRefuseSended'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Track $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Track $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Track $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        //
    }

    public function sendRequest(int $id)
    {
        $track = Track::findOrFail($id);

        $user_id = auth()->user()->id;
        $trackUserRequest = TrackUserRequest::where('user_id_sender', $user_id)
        ->where('track_id', $track->id)
        ->first();

        if (!isset($trackUserRequest)) {
            TrackUserRequest::create([
                'user_id_sender'=>$user_id,
                'track_id'=>$track->id,
                'joining'=>true,
                'refused'=>false,
                'action'=>'send',
            ]);
        } else {
            $trackUserRequest->update([
                'joining'=>true,
                'refused'=>false,
                'action'=>'send',
            ]);
        }

        return redirect()->route('tracks.show', $track->id);
    }

    public function sendRefuseRequest(int $id)
    {
        $track = Track::findOrFail($id);
        $user_id = auth()->user()->id;
        $trackUserRequest = TrackUserRequest::where('user_id_sender', $user_id)
        ->where('track_id', $track->id)
        ->first();

        if (!isset($trackUserRequest)) {
            TrackUserRequest::create([
                'user_id_sender'=>$user_id,
                'track_id'=>$track->id,
                'joining'=>false,
                'refused'=>true,
                'action'=>'send',
            ]);
        } else {
            $trackUserRequest->update([
                'joining'=>false,
                'refused'=>true,
                'action'=>'send',
            ]);
        }

        return redirect()->route('tracks.show', $track->id);
    }

    public function userAccepted(Track $track, User $user)
    {
        $user_id = $user->id;
        $trackUserRequest = TrackUserRequest::where('user_id_sender', $user_id)
        ->where('track_id', $track->id)
        ->first();

        $trackUserRequest->update([
            'joining'=>true,
            'refused'=>false,
            'action'=>'accepted',
        ]);

        $user->tracks()->toggle($track);

        return redirect()->back();
    }
}
