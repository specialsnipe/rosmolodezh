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

class AnswerController extends Controller
{

    /**
     * @param Track $track
     * @param Block $block
     * @param Exercise $exercise
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Exercise $exercise)
    {
        $block = $exercise->block;
        $track = $block->track;
        $users = $track->users;
        return view('admin.answers.index', compact('track', 'block', 'exercise', 'users'));
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
     * @param \App\Http\Requests\Answer\StoreAnswerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswerRequest $request)
    {
        //
    }


    /**
     * @param Track $track
     * @param Block $block
     * @param Exercise $exercise
     * @param Answer $answer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Exercise $exercise, Answer $answer)
    {
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
}
