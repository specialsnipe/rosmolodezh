<?php

namespace App\Http\Livewire;

use App\Models\ComplexityTime;
use App\Models\File;
use Livewire\Component;
use App\Models\Exercise;
use App\Models\Complexity;
use App\Models\Link;
use Livewire\WithFileUploads;

class ExerciseEditComponent extends Component
{
    use WithFileUploads;

    public $block;
    public $exercise;
    public $complexities;
    public $complexity_times;
    public $levels = [];
    public $complexity_id;
    public $exercise_title;
    public $exercise_excerpt;
    public $exercise_body;
    public $exercise_time;

    public $stepFrame = 1;

    public $links = [];
    public $link_name;
    public $link_url;

    public $files = [];

    public $exercise_files = [];

    public $file;
    public $file_title;
    public $file_url = '';
    public $file_body;

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

        $this->exercise->updateOrFail([
            'title' => $this->exercise_title,
            'excerpt' => $this->exercise_excerpt,
            'body' => $this->exercise_body ?: '',
            'complexity_id' => $this->complexity_id,
            'time' => $this->exercise_time,
            'user_id' => auth()->user()->id,
            'block_id' => $this->block->id,
        ]);

        // dd($this->exercise);

        session()->flash('message', 'Упражнение успешно обновлено! Добавьте новые ссылки, видео и файлы или удалите старые.');

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

    public function addFileToExercise()
    {
        $this->validate([
            'file'=>['required','file', 'max:10024'],
            'file_title'=>['required'],
            'file_body'=>['required'],
        ], [
            'file.required' => 'Обязательно добавьте хотя бы один файл',
            'file.max' => 'Файл слишком много весит! (не более 10 мб)',
            'file_title.required' => 'Обязательно назовите ваш файл',
            'file_body.required' => 'Добавьте краткое описание к файлу',
        ]);

        if(isset($this->file)) {
            File::create([
                'title' => $this->file_title,
                'url' => $this->file_url ?? '',
                'body' => $this->file_body ?? '',
                'file_name' => $this->file->hashName(),
                'file_type' => $this->file->getClientOriginalExtension(),
                'file_size' => $this->file->getSize() / 1024,
                'user_id' => auth()->user()->id,
                'track_id' => $this->block->track->id,
                'block_id' => $this->block->id,
                'exercise_id' => $this->exercise->id,
            ]);

            $this->file->storeAs('public/exercise/uploaded_files', $this->file->hashName());

            $this->file_title = '';
            $this->file = '';
            $this->file_body = '';
            $this->exercise_files = File::where('exercise_id', $this->exercise->id)->get();

        }

    }

    public function deleteLink($link)
    {
        $link = Link::find($link);
        if (!isset($link)) {
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

    public function deleteFile(File $file)
    {
        $file->delete();
        $this->exercise_files = File::where('exercise_id', $this->exercise->id)->get();
    }


    public function completeExerciseEdit()
    {
        return redirect()->route('profile.blocks.exercises.show', [$this->block->slug, $this->exercise->slug]);
    }

    // public function mount()
    // {
    //     $this->links =  $this->exercise->links;
    // }
    public function render()
    {

        $this->complexities = Complexity::all();
        foreach ($this->complexities as $complexity) {
            $this->levels[$complexity->id] = $complexity->level;
        }


        return view('livewire.admin.exercises.exercise-edit-component');
    }

    public function mount(Exercise $exercise)
    {
        $this->complexity_times = ComplexityTime::all();
        $this->exercise_title = $exercise->title;
        $this->exercise_excerpt = $exercise->excerpt;
        $this->exercise_body = $exercise->body;
        $this->exercise_time = $exercise->time;
        $this->links = $exercise->links;
        $this->complexity_id = $exercise->complexity_id;
        $this->exercise_files = $exercise->files;
    }
}
