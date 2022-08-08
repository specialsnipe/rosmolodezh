<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\StoreAnswerRequest;
use App\Http\Requests\Answer\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\AnswerFile;
use App\Models\Block;
use App\Models\Exercise;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * @param Exercise $exercise
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Exercise $exercise)
    {
        return view('admin.answers.create', compact('exercise'));
    }


    /**
     * @param StoreAnswerRequest $request
     * @param Exercise $exercise
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAnswerRequest $request, Exercise $exercise)
    {
        $data = $request->validated();
        $files = $data['file'];

        unset($data['file']);

        $data['user_id'] = auth()->user()->id;
        $data['exercise_id'] = $exercise->id;
        $answer = Answer::firstOrCreate($data);



        if ($files) {
            foreach ($files as $file) {
                $fileName = $file->hashName();

                $fileExtension = $file->extension();
                $originalFileName = $file->getClientOriginalName();

                $path = Storage::disk('public')->path('users/answers');
                $file->move($path, $fileName);

                $fileData['answer_id'] = $answer->id;
                $fileData['file_name'] = $fileName;
                $fileData['type'] = $fileExtension;
                $fileData['original_file_name'] = $originalFileName;
                AnswerFile::firstOrCreate($fileData);
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

    public function changeMark(Request $request,Exercise $exercise, Answer $answer)
    {

        $answer->update([
           'mark'=>$request->input('mark'),
        ]);
        $block = $exercise->block;

        return redirect()->route('admin.blocks.exercises.show',[$block->id, $exercise->id] );
    }
}
