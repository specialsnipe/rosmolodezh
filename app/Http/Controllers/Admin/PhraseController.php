<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Phrase\StorePhraseRequest;
use App\Http\Requests\Phrase\UpdatePhraseRequest;
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
        return view('admin.settings.phrases.create');
    }


    /**
     * @param StorePhraseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePhraseRequest $request)
    {
        $data = $request->validated();
        Phrase::firstOrCreate($data);
        return redirect()
            ->route('admin.settings.phrases.create')
            ->with(['success'=> 'Фраза успешно сохранена']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phrase  $landingPhrase
     * @return \Illuminate\Http\Response
     */
    public function show(Phrase $phrase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phrase  $phrase
     * @return \Illuminate\Http\Response
     */
    public function edit(Phrase $phrase)
    {
        return view('admin.settings.phrases.edit', compact('phrase'));
    }


    public function update(UpdatePhraseRequest $request, Phrase $phrase)
    {
        $data = $request->validated();
        $phrase->updateOrFail($data);

        return redirect()
            ->route('admin.settings.phrases.edit', $phrase->id)
            ->with(['success'=> 'Фраза успешно изменена']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phrase  $phrase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phrase $phrase)
    {
        //
    }
}
