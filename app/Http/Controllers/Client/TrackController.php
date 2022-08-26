<?php

namespace App\Http\Controllers\Client;

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

    /**
     * Display the specified resource.
     *
     * @param  int  Track $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        foreach (auth()->user()->tracks_request as $trackFromUser) {
            if ($track->id == $trackFromUser->id) {
                $is_added = true;
            }
        }
        return view('tracks.show', compact('track'));
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

    public function sendRequest(Track $track)
    {
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
    public function sendRefuseRequest(Track $track)
    {
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
}
