<?php

namespace App\Http\Controllers;

use App\Models\TrackUserRequest;
use App\Http\Requests\StoreTrackUserRequestRequest;
use App\Http\Requests\UpdateTrackUserRequestRequest;

class TrackUserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTrackUserRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrackUserRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrackUserRequest  $trackUserRequest
     * @return \Illuminate\Http\Response
     */
    public function show(TrackUserRequest $trackUserRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrackUserRequest  $trackUserRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackUserRequest $trackUserRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrackUserRequestRequest  $request
     * @param  \App\Models\TrackUserRequest  $trackUserRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrackUserRequestRequest $request, TrackUserRequest $trackUserRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrackUserRequest  $trackUserRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackUserRequest $trackUserRequest)
    {
        //
    }
}
