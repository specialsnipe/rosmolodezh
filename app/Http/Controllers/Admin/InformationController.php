<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSettingRequest;
use App\Http\Requests\Setting\UpdateSliderRequest;
use App\Models\Information;

class InformationController extends Controller
{

    public function index()
    {
        $setting = Information::first();
        return view('admin.settings.information.index', compact('setting'));
    }
    /**
     * @param UpdateSliderRequest $request
     * @param Information $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSliderRequest $request, Information $setting)
    {
        $data = $request->validated();
        $setting->update($data);
        return redirect()->route('admin.settings.information.index');
    }
}
