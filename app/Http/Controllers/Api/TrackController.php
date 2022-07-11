<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrackResource;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TrackResource::collection(Track::all());
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
     * @param  Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track  $track)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  Track  $track
     * @return \Illuminate\Http\Response
     */
    public function allBlocks(Track  $track)
    {
        return $track->blocks;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track  $track)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track  $track)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track  $track)
    {
        //
    }
}
