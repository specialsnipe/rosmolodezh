<?php

namespace App\Http\Livewire;
use App\Models\Answer;
use Livewire\Component;
use App\Models\Exercise;
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

    public function uploadFile()
    {
        $body = $this->body;
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
        $this->body = $body;
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
    public function updatedBody()
    {
        $this->validate([
            'body' => 'required'
        ],[
            'body.required' => 'Обязательно оставьте коментарий к задаче'
        ]);
    }
    public function saveAnswer()
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
        return redirect()->route('profile.tracks.block.show', [$this->block->track_id,$this->block->id]);
    }

    public function render()
    {
        $this->answer = Answer::where('exercise_id', $this->exercise->id)
                                ->where('user_id', auth()->user()->id)->first();

        $this->bodyDefault = $this->answer->body ?? '';

        if($this->answer == null) {
            $this->answer = Answer::create([
                'body' => '',
                'exercise_id' => $this->exercise->id,
                'mark' => null,
                'user_id' => auth()->user()->id
            ]);
        }

        $this->files = AnswerFile::where('user_id', auth()->user()->id)
                                ->where('answer_id', $this->answer->id)->get();
        if($this->files->count() < 0) {
            $this->files = [];
        }
        return view('livewire.send-answer-to-exercise-component');
    }
}
