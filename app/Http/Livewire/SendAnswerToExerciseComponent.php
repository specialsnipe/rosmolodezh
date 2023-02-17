<?php

namespace App\Http\Livewire;
use App\Models\Answer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use App\Models\AnswerFile;
use Livewire\WithFileUploads;
use App\Events\AnswerToExerciseSended;
use Illuminate\Support\Facades\Storage;

class SendAnswerToExerciseComponent extends Component
{
    use WithFileUploads;

    public $block;
    public $exercise;
    public $answer;
    public $body;
    public $bodyDefault;
    public $file;
    public $files = [];
    public bool $modalDeleteAnswer = false;

    public function uploadFile()
    {
        $this->validate([
            'file' => ['required','file','max:2048'],
        ],[
            'file.required' => 'Поле обязательно для заполнения',
            'file.file' => 'Это должно быть файлом',
            'file.max' => 'Слишком большой файл',
        ]);

        AnswerFile::query()
            ->create([
                'answer_id' => $this->answer->id,
                'user_id' => auth()->user()->id,
                'file_name' => $this->file->hashName(),
                'file_size' => $this->file->getSize() / 1024,
                'file_type' => $this->file->getClientOriginalExtension(),
                'original_file_name' => $this->file->getClientOriginalName(),
            ]);

        $this->file->store('users/answers', 'public', $this->file->hashName());
        $this->file = null;

        $this->files = AnswerFile::query()
            ->where('user_id', auth()->user()->id)
            ->where('answer_id', $this->answer->id)->get();

        if($this->files->count() < 0) $this->files = [];
    }

    public function deleteFile($file_id)
    {

        $file = AnswerFile::find($file_id);
        if (Storage::disk('public')->exists('users/answers/uploaded_files', $file->file_name)) {
            Storage::disk('public')->delete('users/answers/uploaded_files', $file->file_name);
        }
        $file->delete();

        $this->file = null;

        $this->files = AnswerFile::where('user_id', auth()->user()->id)
                                    ->where('answer_id', $this->answer->id)->get();
        if($this->files->count() < 0) {
            $this->files = [];
        }
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|file|max:2048', // 1MB Max
        ]);
    }

    public function toggleModalDelete()
    {
        $this->modalDeleteAnswer = !$this->modalDeleteAnswer;
    }

    public function updatedBody()
    {
        $this->bodyDefault = $this->body;
        $this->validate([
            'body' => 'required'
        ],[
            'body.required' => 'Обязательно оставьте коментарий к задаче'
        ]);
    }

    public function saveAnswer(): RedirectResponse
    {
        $this->validate([
            'body' => 'required'
        ],[
            'body.required' => 'Обязательно оставьте коментарий к задаче'
        ]);

        if(!$this->answer->sended) {
            $message = "Упражнение '<b>{$this->exercise->title}</b>' / \nБлок '<b>{$this->exercise->block->title}</b>' / \nНаправление '<b>{$this->exercise->block->track->title}</b>'\n";
            $message .= "\nВы успешно отправили ответ на задание, ждите оценку от преподавателя!";
            event(new AnswerToExerciseSended($this->answer->user->tg_id, $message));
        }
        $this->answer->update([
            'body' => $this->body,
            'sended' => true
        ]);
        return redirect()->route('profile.tracks.blocks.show', [$this->block->track->slug,$this->block->slug]);
    }

    public function outWithoutSave(): RedirectResponse
    {
        $this->answer->forceDelete();
        return redirect()->route('profile.tracks.blocks.show', [$this->block->track->slug,$this->block->slug]);
    }

    public function mount()
    {
        $this->answer = Answer::query()
            ->where('exercise_id', $this->exercise->id)
            ->where('user_id', auth()->user()->id)->first();


        $this->bodyDefault = $this->answer->body ?? '';
        $this->body = $this->answer->body ?? '';

        if($this->answer == null) {
            $this->answer = Answer::query()
                ->create([
                    'body' => '',
                    'exercise_id' => $this->exercise->id,
                    'mark' => null,
                    'user_id' => auth()->user()->id
                ]);
        }

        $this->files = AnswerFile::query()
            ->where('user_id', auth()->user()->id)
            ->where('answer_id', $this->answer->id)->get();

        if($this->files->count() < 0) {
            $this->files = [];
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.send-answer-to-exercise-component');
    }
}
