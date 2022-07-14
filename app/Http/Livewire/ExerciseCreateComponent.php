<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exercise;
use App\Models\Complexity;
use App\Models\Link;

class ExerciseCreateComponent extends Component
{
    public $block;
    public $exercise;
    public $complexities;
    public $levels = [];
    public $complexity_id = 1;
    public $exercise_title;
    public $exercise_excerpt;
    public $exercise_body;
    public $exercise_time;

    public $stepFrame = 1;

    public $links = [];
    public $link_name;
    public $link_url;

    public $files = [];

    public function toStageTwo()
    {
        $this->validate([
            'exercise_title' => 'required',
            'exercise_excerpt' => 'required',
            'exercise_body' => 'required',
            'exercise_time' => 'required|numeric|min:10',
        ], [
            'exercise_title.required' => 'Заголовок обязателен для задания',
            'exercise_excerpt.required' => 'Краткое описание обязательно',
            'exercise_body.required' => 'Описание задания обязательно',
        ]);

        $this->exercise = Exercise::create([
            'title' => $this->exercise_title,
            'excerpt' => $this->exercise_excerpt,
            'body' => $this->exercise_body ?: '',
            'complexity_id' => $this->complexity_id,
            'time' => $this->exercise_time,
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

        session()->flash('message', 'Ссылка к упражнению создана, создадим ещё?');

    }

    public function deleteLink($link)
    {
        $link = Link::find($link);
        if(!isset($link)) {
            $this->links = Link::where('exercise_id', $this->exercise->id)->get();
            session()->flash('error', 'Что то не так... :(');
        } else {
            $link->delete();
            $this->links = Link::where('exercise_id', $this->exercise->id)->get();
        }

        $this->links = Link::where('exercise_id', $this->exercise->id)->get();

        session()->flash('info', 'Ссылка была успешно удалена :) Не хотите добавить другую?');
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
        return redirect()->route('admin.tracks.blocks.show',[ $this->block->track_id, $this->block->id]);
    }

    // public function mount()
    // {
    //     $this->links =  $this->exercise->links;
    // }
    public function render()
    {

        $this->complexities = Complexity::all();
        foreach ($this->complexities as $complexity) {
            $this->levels[$complexity->id] =  $complexity->level;
        }
        return view('livewire.admin.exercises.exercise-create-component');
    }
}
