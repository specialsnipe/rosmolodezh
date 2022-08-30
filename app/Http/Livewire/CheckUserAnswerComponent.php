<?php

namespace App\Http\Livewire;

use App\Models\Track;
use App\Models\Answer;
use Livewire\Component;

class CheckUserAnswerComponent extends Component
{
    public $students;
    public $exercise;
    public $modalOpened = false;
    public $answer;
    public $answerFiles;
    public $answerBody;
    public $answerUser;
    public $answerDate;

    public function openAnswerModal($answerId)
    {
        $answer = Answer::find($answerId);
        $this->answer = $answer;
        $this->answerFiles = $answer->answerFiles;
        $this->answerBody = $answer->body;
        $this->answerUser = $answer->user;
        $this->answerDate = $answer->created_at;
        $this->modalOpened = true;
    }

    public function closeModal()
    {
        $this->modalOpened = false;
    }

    public function rateAnswer($mark)
    {
        $this->answer->update([
            'mark'=>$mark
        ]);
        $this->students = Track::find($this->exercise->block->track_id)->students;
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.check-user-answer-component');
    }
}
