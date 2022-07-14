<?php

namespace App\Http\Controllers;

use App\Models\Complexity;
use App\Http\Requests\StoreComplexityRequest;
use App\Http\Requests\UpdateComplexityRequest;

class ComplexityController extends Controller
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
     * @param  \App\Http\Requests\StoreComplexityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComplexityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complexity  $complexity
     * @return \Illuminate\Http\Response
     */
    public function show(Complexity $complexity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complexity  $complexity
     * @return \Illuminate\Http\Response
     */
    public function edit(Complexity $complexity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComplexityRequest  $request
     * @param  \App\Models\Complexity  $complexity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComplexityRequest $request, Complexity $complexity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complexity  $complexity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complexity $complexity)
    {
        //
    }
}
