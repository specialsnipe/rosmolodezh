<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\StoreExerciseRequest;
use App\Http\Requests\Exercise\UpdateExerciseRequest;
use App\Models\Block;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Block $block)
    {
        $track_id = $block->track_id;
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Block $block)
    {
        return view('admin.exercise.create', ['block' => $block]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreExerciseRequest $request, Block $block)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['block_id'] = $block->id;
        $track_id = $block->track_id;

        // TODO: Сохранение файлов, видосов и ссылок
        $exercise = Exercise::create($data);
        // if($request->hasFiles('videos'))
        // foreach ()
        // $exercise = Exercise::create($data);
        // ret

    }

    /**
     * Display the specified resource.
     *
     */
    public function show( Block $block, Exercise $exercise)
    {
        $track_id = $block->track_id;



    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Block $block, Exercise $exercise)
    {
        $track_id = $block->track_id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Exercise\UpdateExerciseRequest  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExerciseRequest $request, Block $block, Exercise $exercise)
    {
        $track_id = $block->track_id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block, Exercise $exercise)
    {
        $track_id = $block->track_id;
    }
}
