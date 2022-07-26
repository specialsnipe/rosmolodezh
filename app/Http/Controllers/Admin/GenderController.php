<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gender\StoreGenderRequest;
use App\Http\Requests\Gender\UpdateGenderRequest;
use App\Models\Gender;

class GenderController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $genders = Gender::all();
        return view('admin.genders.index', compact('genders'));
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.genders.create');
    }


    /**
     * @param StoreGenderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGenderRequest $request)
    {
        $data = $request->validated();
        Gender::firstOrCreate($data);
        return redirect()->route('admin.genders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function show(Gender $gender)
    {
        //
    }


    /**
     * @param Gender $gender
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Gender $gender)
    {
        return view('admin.genders.edit', compact('gender'));
    }


    /**
     * @param UpdateGenderRequest $request
     * @param Gender $gender
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGenderRequest $request, Gender $gender)
    {
        $data = $request->validated();
        $gender->update($data);
        return redirect()->route('admin.genders.index');
    }


    /**
     * @param Gender $gender
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Throwable
     */
    public function destroy(Gender $gender)
    {
        try {
            $gender->deleteOrFail();
            return redirect()->route('admin.genders.index');
        }catch (\Exception $e) {
            abort(501);
        }
    }
}
