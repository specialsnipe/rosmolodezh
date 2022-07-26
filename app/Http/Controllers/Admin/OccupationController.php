<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Occupation\StoreOccupationRequest;
use App\Http\Requests\Occupation\UpdateOccupationRequest;
use App\Models\Occupation;

class OccupationController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $occupations = Occupation::all();
        return view('admin.occupations.index', compact('occupations'));
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.occupations.create');
    }


    /**
     * @param StoreOccupationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOccupationRequest $request)
    {
        $data = $request->validated();
        Occupation::firstOrCreate($data);
        return redirect()->route('admin.occupations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        //
    }


    /**
     * @param Occupation $occupation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Occupation $occupation)
    {
        return view('admin.occupations.edit', compact('occupation'));
    }


    /**
     * @param UpdateOccupationRequest $request
     * @param Occupation $occupation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateOccupationRequest $request, Occupation $occupation)
    {
        $data = $request->validated();
        $occupation->update($data);
        return redirect()->route('admin.occupations.index');
    }


    /**
     * @param Occupation $occupation
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Throwable
     */
    public function destroy(Occupation $occupation)
    {
        try {
            $occupation->deleteOrFail();
            return redirect()->route('admin.occupations.index');
        }catch (\Exception $e) {
            abort(501);
        }
    }
}
