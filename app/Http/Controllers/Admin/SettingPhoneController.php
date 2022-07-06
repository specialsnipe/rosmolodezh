<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingPhone\StoreSettingPhoneRequest;
use App\Http\Requests\SettingPhone\UpdateSettingPhoneRequest;
use App\Models\SettingPhone;

class SettingPhoneController extends Controller
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
     * @param  \App\Http\Requests\SettingPhone\StoreSettingPhoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingPhoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Http\Response
     */
    public function show(SettingPhone $settingPhone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingPhone $settingPhone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingPhone\UpdateSettingPhoneRequest  $request
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingPhoneRequest $request, SettingPhone $settingPhone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingPhone $settingPhone)
    {
        //
    }
}
