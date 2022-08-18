<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandingPhraseRequest;
use App\Http\Requests\UpdateLandingPhraseRequest;
use App\Models\Phrase;

class PhraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phrases = Phrase::all();
        return view('admin.settings.phrases.index', compact('phrases'));
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
     * @param  \App\Http\Requests\StoreLandingPhraseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandingPhraseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phrase  $landingPhrase
     * @return \Illuminate\Http\Response
     */
    public function show(Phrase $landingPhrase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phrase  $landingPhrase
     * @return \Illuminate\Http\Response
     */
    public function edit(Phrase $landingPhrase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandingPhraseRequest  $request
     * @param  \App\Models\Phrase  $landingPhrase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandingPhraseRequest $request, Phrase $landingPhrase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phrase  $landingPhrase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phrase $landingPhrase)
    {
        //
    }
}
