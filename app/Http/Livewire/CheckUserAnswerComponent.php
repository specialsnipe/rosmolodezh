<?php

namespace App\Http\Livewire;

use App\Models\Track;
use App\Models\Answer;
use Livewire\Component;
use App\Events\ErrorOnExerciseComplete;
use App\Events\SendMessageAboutMarkSet;

class CheckUserAnswerComponent extends Component
{
    public $students;
    public $exercise;
    public $modalOpened = false;
    public $modalInfoOpened = false;
    public $answer;
    public $answerFiles;
    public $answerBody;
    public $answerUser;
    public $answerDate;
    public $requiredToMessage;
    public $messageToStudent;

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

    public function closeInfoModal()
    {
        $this->modalInfoOpened = false;
    }

    public function sendToTgAboutError()
    {
        $message = event(new ErrorOnExerciseComplete($this->answer->user->tg_id, (string)view('telegram.message-from-teacher', [
            'teacherName' => auth()->user()->firstAndLastNames,
            'data' => $this->requiredToMessage,
            'message' => $this->messageToStudent,
        ])));
        if ($message[0]->getStatusCode() >= 200 && $message[0]->getStatusCode() < 300) {
            session()->flash('message', 'Успешно отправлено сообщение пользователю');
            $this->modalOpened = false;
        } else {
            session()->flash('error', 'Сообщение не было отправлено! Какая то ошибка');
        };
    }

    public function rateAnswer($mark)
    {
        $this->answer->update([
            'mark'=>$mark
        ]);
        $stars = '';
        $sticker = '';
        for ($i=1; $i<=$mark ; $i++) {
            $stars .= '⭐';
        }
        switch ($mark) {
            case 1:
                $sticker = '👎';
                break;

            case 2:
                $sticker = '🥶';
                break;

            case 3:
                $sticker = '🤔';
                break;

            case 4:
                $sticker = '🤩';
                break;
            case 5:
                $sticker = '🥳';
                break;

            default:
                # code...
                break;
        }
        $user = auth()->user()->firstAndLastNames;

        $this->students = Track::find($this->exercise->block->track_id)->students;
        $message = event(new SendMessageAboutMarkSet($this->answer->user->tg_id, (string)view('telegram.message-about-mark', [
            'stars' => $stars,
            'data' => $this->requiredToMessage,
            'message' => "Вы получили оценку за задание: <b>{$mark}</b> {$sticker} \nПоставил оценку: <b>{$user}</b>",
        ])));

        $this->closeModal();
    }

    public function mounted()
    {
        $this->messageToStudent = "Вы недоделали домашнее задание к упражнению '{$this->exercise->title}' в блоке '{$this->exercise->block->title}' (направление '{$this->exercise->block->track->title}'). Чтобы получить хорошую оценку пожалуйста, доделайте упражнение.";
    }

    public function render()
    {
        $this->requiredToMessage = "Упражнение '<b>{$this->exercise->title}</b>' / \nБлок '<b>{$this->exercise->block->title}</b>' / \nНаправление '<b>{$this->exercise->block->track->title}</b>'";
        return view('livewire.check-user-answer-component');
    }
}
