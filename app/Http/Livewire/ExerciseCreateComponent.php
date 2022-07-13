<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exercise;

class ExerciseCreateComponent extends Component
{
    public $block;
    public $exercise;
    public $stepFrame = 2;
    public $exercise_title;
    public $exercise_excerpt;
    public $exercise_body;
    public $validatedData;

    public function toStageTwo()
    {
        $this->validatedData = $this->validate([
            'exercise_title' => 'required',
            'exercise_excerpt' => 'required',
            'exercise_body' => 'required',
        ]);
        $this->validatedData['user_id'] = auth()->user()->id;
        $this->validatedData['user_id'] = auth()->user()->id;
        $this->exercise = Exercise::create([
            'title' => $this->exercise_title,
            'excerpt' => $this->exercise_excerpt,
            'body' => $this->exercise_body ?: '',
            'user_id' => auth()->user()->id,
            'block_id' => $this->block->id,
        ]);

        session()->flash('message', 'Упражнение успешно создано. Продолжим создание! Добавьте полезные ссылки, видео и файлы.');

        $this->stepFrame = 2;
    }

    public function completeExerciseCreate()
    {
        $this->exercise->update([
            'exercise_body' => $this->exercise_body,
        ]);
        $this->stepFrame++;
    }

    public function render()
    {
        return view('livewire.exercise-create-component');
    }
}
