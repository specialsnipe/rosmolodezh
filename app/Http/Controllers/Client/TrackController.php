<?php

namespace App\Http\Controllers\Client;

use App\Models\Track;
use Illuminate\Http\Request;
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

    public function addTrackForUser(Track $track)
    {
        $user = auth()->user()->id;
        $track->users()->toggle($user);
//        $tracks = Track::all();
//        $allAverageMark = [];
//        foreach ($tracks as $track) {
//            $allAverageMark[] = AverageMarkTrack::getMark($track);
//        }
        return redirect()->route('tracks.show', $track->id);
    }
}
