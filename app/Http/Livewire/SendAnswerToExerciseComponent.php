<?php

namespace App\Http\Livewire;
use App\Models\Answer;
use Livewire\Component;
use App\Models\Exercise;
use App\Models\AnswerFile;
use Livewire\WithFileUploads;
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

    public function uploadFile()
    {
        $this->validate([
            'file' => ['required','file','max:2048'],
        ],[
            'file.required' => 'Поле обязательно для заполнения',
            'file.file' => 'Это должно быть файлом',
            'file.file' => 'Файл слишком много весит',
        ]);
        AnswerFile::create([
            'answer_id' => $this->answer->id,
            'user_id' => auth()->user()->id,
            'file_name' => $this->file->hashName(),
            'file_size' => $this->file->getSize() / 1024,
            'file_type' => $this->file->getClientOriginalExtension(),
            'original_file_name' => $this->file->getClientOriginalName(),
        ]);
        $this->file->storeAs('public/users/answers/uploaded_files', $this->file->hashName());

        $this->file = null;
        $this->body = '';

        $this->files = AnswerFile::where('user_id', auth()->user()->id)
                                    ->where('answer_id', $this->answer->id)->get();
        if($this->files->count() < 0) {
            $this->files = [];
        }
    }
    public function deleteFile($file_id)
    {

        $file = AnswerFile::find($file_id);
        if (Storage::disk('public')->exists('users/answers/uploaded_files', $file->file_name)) {
            Storage::disk('public')->delete('users/answers/uploaded_files', $file->file_name);
        }
        $file->delete();

        $this->file = '';
        $this->body = '';

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
    public function saveAnswer()
    {
        $this->validate([
            'body' => 'required'
        ],[
            'body.required' => 'Обязательно оставьте коментарий к задаче'
        ]);
        $this->answer->update([
            'body' => $this->body
        ]);

        return redirect()->route('profile.block.show', [ $this->block]);
    }

    public function render()
    {
        $this->answer = Answer::where('exercise_id', $this->exercise->id)
                                ->where('user_id', auth()->user()->id)->first();

        $this->files = AnswerFile::where('user_id', auth()->user()->id)
                                ->where('answer_id', $this->answer->id)->get();
        $this->bodyDefault = $this->answer->body;
        if($this->files->count() < 0) {
            $this->files = [];
        }
        if($this->answer == null) {
            $this->answer = Answer::create([
                'body' => '',
                'exercise_id' => $this->exercise->id,
                'mark' => null,
                'user_id' => auth()->user()->id
            ]);
        }
        return view('livewire.send-answer-to-exercise-component');
    }
}
