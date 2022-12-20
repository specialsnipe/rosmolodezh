<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\about\UpdateAboutRequest;
use App\Models\About;
use App\Models\Partnership;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnershipRequest;
use App\Http\Requests\UpdatePartnershipRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $about = About::first();
        return view('admin.settings.about.index', compact('about'));
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
     * @param  \App\Http\Requests\StorePartnershipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnershipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function show(Partnership $partnership)
    {
        //
    }


    /**
     * @param Partnership $partnership
     * @return Application|Factory|View
     */
    public function edit(About $about)
    {
        $grants = $about->grantItems;
        $advantages = $about->advantageItems;
        return view('admin.settings.about.edit', compact(['about', 'advantages','grants']));
    }


    /**
     * @param UpdatePartnershipRequest $request
     * @param Partnership $partnership
     * @return RedirectResponse
     */
    public function update(UpdateAboutRequest $request, Partnership $partnership)
    {
        $data = $request->validated();
        dd($data);
        try{
            $partnership->update($data);
            return back()
                ->with('success', 'Данные успешно обновлены');
        }catch (\Exception $e){
            return back()
                ->with('error', 'Что-то пошло не так');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partnership  $partnership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partnership $partnership)
    {
        //
    }
}
