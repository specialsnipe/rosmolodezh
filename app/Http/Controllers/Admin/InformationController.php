<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSettingRequest;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Models\Information;

class InformationController extends Controller
{

    public function index()
    {
        $setting = Information::first();
        return view('admin.settings.information.index', compact('setting'));
    }
    /**
     * @param UpdateSettingRequest $request
     * @param Information $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSettingRequest $request, Information $setting)
    {
        $data = $request->validated();
        $setting->update($data);
        return redirect()->route('admin.settings.information.index');
    }
}
