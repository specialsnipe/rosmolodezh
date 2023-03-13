<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\StoreAnswerRequest;
use App\Http\Requests\Answer\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Block;
use App\Models\Exercise;
use App\Models\Track;
use App\Models\User;
use App\Services\Answers\AnswerFileStore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    /**
     * @param Exercise $exercise
     * @return Application|Factory|View
     */
    public function index(Exercise $exercise)
    {
        $block = $exercise->block;
        $track = $block->track;
        $users = $track->users;
        return view('admin.answers.index', compact('track', 'block', 'exercise', 'users'));
    }


    /**
     * @param Exercise $exercise
     * @return Application|Factory|View
     */
    public function create(Exercise $exercise)
    {
        return view('admin.answers.create', compact('exercise'));
    }


    /**
     * @param StoreAnswerRequest $request
     * @param Exercise $exercise
     * @return RedirectResponse
     */
    public function store(StoreAnswerRequest $request, Exercise $exercise)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['exercise_id'] = $exercise->id;

        $files = $data['file'];
        unset($data['file']);

        $answer = Answer::firstOrCreate($data);

        if ($files) {
            foreach ($files as $file) {
                AnswerFileStore::store($file, $answer);
            }
        }

        $block = $exercise->block;

        return redirect()->route('admin.blocks.exercises.show', [$block->id, $exercise->id]);
    }


    /**
     * @param Track $track
     * @param Block $block
     * @param Exercise $exercise
     * @param Answer $answer
     * @return Application|Factory|View
     */
    public function show($exercise, $answer)
    {
        $exercise = Exercise::query()
            ->find($exercise);
        $answer = Answer::query()
            ->find($answer);
        $block = $exercise->block;
        $track = $block->track;
        $user = $answer->user;
        return view('admin.answers.show', compact('track', 'block', 'exercise', 'answer', 'user'));
    }

    /**
     * @param Track $track
     * @param Block $block
     * @param Exercise $exercise
     * @param User $user
     * @return void
     */
    public function show_user_answer(Track $track, Block $block, Exercise $exercise, User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Answer\UpdateAnswerRequest $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }

    public function changeMark(Request $request,Exercise $exercise, Answer $answer)
    {

        $answer->update([
           'mark'=>$request->input('mark'),
        ]);
        $block = $exercise->block;

        return redirect()->route('admin.blocks.exercises.show',[$block->id, $exercise->id] );
    }
}
