<?php

namespace App\Http\Controllers\Client;

use App\Models\Answer;
use App\Models\Block;
use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
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
     * @param \App\Models\Block $block
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Block $block)
    {
        $this->authorize('create', Exercise::class);
        return view('profile.exercise.create', compact('block'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Block $block, Exercise $exercise)
    {
        $this->authorize('view', $exercise);
        $students = $block->track->students;
        $track = $block->track;
        return view('profile.exercise.show', compact('track','exercise', 'block', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Block $block, Exercise $exercise)
    {
        return view('profile.exercise.edit', compact('block', 'exercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Block $block, Exercise $exercise)
    {
        try {
            DB::beginTransaction();
            Answer::where('exercise_id', $exercise->id)->delete();
            $exercise->deleteOrFail();

            $track = $block->track;
            DB::commit();
            return redirect()->route('profile.tracks.blocks.show', [$track->slug, $block->slug]);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }
}
