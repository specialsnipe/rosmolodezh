<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSettingRequest;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }
    /**
     * @param UpdateSettingRequest $request
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $data = $request->validated();
        $setting->update($data);
        return redirect()->route('admin.settings.index');
    }
}
