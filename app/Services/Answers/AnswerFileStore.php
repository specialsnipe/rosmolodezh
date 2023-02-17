<?php

namespace App\Services\Answers;

use App\Models\Answer;
use App\Models\AnswerFile;
use Illuminate\Support\Facades\Storage;

class AnswerFileStore
{
    public static function store($file, Answer $answer): bool
    {
        $fileData = [
            'answer_id' => $answer->id,
            'file_name' => $file->hashName(),
            'type' => $file->extension(),
            'original_file_name' => $file->getClientOriginalName(),
        ];

        $path = Storage::disk('public')->path('users/answers');
        $file->move($path, $fileData['file_name']);

        $answerFile = AnswerFile::firstOrCreate($fileData);
        if ($answerFile) return true;
        return false;
    }
}
