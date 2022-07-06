<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingEmail\StoreSettingEmailRequest;
use App\Http\Requests\SettingEmail\UpdateSettingEmailRequest;
use App\Models\SettingEmail;

class SettingEmailController extends Controller
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
     * @param  \App\Http\Requests\SettingEmail\StoreSettingEmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingEmailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingEmail  $settingEmail
     * @return \Illuminate\Http\Response
     */
    public function show(SettingEmail $settingEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingEmail  $settingEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingEmail $settingEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingEmail\UpdateSettingEmailRequest  $request
     * @param  \App\Models\SettingEmail  $settingEmail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingEmailRequest $request, SettingEmail $settingEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingEmail  $settingEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingEmail $settingEmail)
    {
        //
    }
}
