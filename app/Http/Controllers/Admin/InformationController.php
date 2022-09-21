<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Information\StoreInformationRequest;
use App\Http\Requests\Information\UpdateInformationRequest;
use App\Models\Information;

class InformationController extends Controller
{

    public function index()
    {
        $information = Information::first();
        return view('admin.settings.information.index', compact('information'));
    }
    /**
     * @param UpdateSliderRequest $request
     * @param Information $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateInformationRequest $request, Information $information)
    {
        $data = $request->validated();
        $information->update($data);
        return redirect()->route('admin.settings.information.index');
    }
}
