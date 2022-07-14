<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exercise;
use App\Models\Link;

class ExerciseCreateComponent extends Component
{
    public $block;
    public $exercise;
    public $stepFrame = 1;
    public $exercise_title;
    public $exercise_excerpt;
    public $exercise_body;
    public $validatedData;

    public $links = [];
    public $link_name;
    public $link_url;

    public $videos = [];
    public $files = [];

    public function toStageTwo()
    {
        $this->validatedData = $this->validate([
            'exercise_title' => 'required',
            'exercise_excerpt' => 'required',
            'exercise_body' => 'required',
        ], [
            'exercise_title.required' => 'Заголовок обязателен для задания',
            'exercise_excerpt.required' => 'Краткое описание обязательно',
            'exercise_body.required' => 'Описание задания обязательно',
        ]);

        $this->exercise = Exercise::create([
            'title' => $this->exercise_title,
            'excerpt' => $this->exercise_excerpt,
            'body' => $this->exercise_body ?: '',
            'user_id' => auth()->user()->id,
            'block_id' => $this->block->id,
        ]);

        // dd($this->exercise);

        session()->flash('message', 'Упражнение успешно создано. Продолжим создание! Добавьте полезные ссылки, видео и файлы.');

        $this->stepFrame = 2;
    }

    public function addLinkToExercise()
    {
        $this->validate([
            'link_name' => 'required',
            'link_url' => ['required', 'url'],
        ], [
            'link_name.required' => 'Название ссылки обязательно',
            'link_url.required' => 'Укажите ссылку чтобы по ней можно было прейти',
            'link_url.url' => 'Поле URL должно быть ссылкой',
        ]);
        Link::create([
            'name' => $this->link_name,
            'url' => $this->link_url,
            'user_id' => auth()->user()->id,
            'exercise_id' => $this->exercise->id,
            'block_id' => $this->block->id,
            'track_id' => $this->block->track_id,
        ]);

        $this->link_name = '';
        $this->link_url = '';

        $this->links = Link::where('exercise_id', $this->exercise->id)->get();
        // foreach($this->links as $link) {
        //     dd($link);
        // }
        session()->flash('message', 'Ссылка к упражнению создана, создадим ещё?');

    }
    public function deleteLink(Link $link)
    {
        $link->delete();
        $this->links = $this->exercise->links;
    }

    // TODO: make edit modal window.
    public function editLink(Link $link)
    {
        $link->delete();
        $this->links = $this->exercise->links;
    }

    public function updateLink(Link $link)
    {
        $this->validate([
            'link_name' => 'required',
            'link_url' => ['required', 'url'],
        ], [
            'link_name.required' => 'Название ссылки обязательно',
            'link_url.required' => 'Укажите ссылку чтобы по ней можно было прейти',
            'link_url.url' => 'Поле URL должно быть ссылкой',
        ]);

        $link->update([
            'name' => $this->link_name,
            'url' => $this->link_url,
        ]);

        $this->links = $this->exercise->links;
    }


    public function completeExerciseCreate()
    {
        $this->exercise->update([
            'exercise_body' => $this->exercise_body,
        ]);
        $this->stepFrame++;
    }

    // public function mount()
    // {
    //     $this->links =  $this->exercise->links;
    // }
    public function render()
    {
        return view('livewire.admin.exercises.exercise-create-component');
    }
}
