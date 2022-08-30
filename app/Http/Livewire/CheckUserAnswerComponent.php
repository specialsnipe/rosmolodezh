<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckUserAnswerComponent extends Component
{
    public $students;
    public $exercise;

    public function render()
    {
        return view('livewire.check-user-answer-component');
    }
}
