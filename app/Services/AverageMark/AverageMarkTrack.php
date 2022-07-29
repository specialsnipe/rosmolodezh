<?php

namespace App\Services\AverageMark;

use App\Models\Answer;

class AverageMarkTrack
{
    public static function getMark($track)
    {
        $score = 0;
        $blocks = $track->blocks;
        $i = 0;
        foreach ($blocks as $block) {
            $exercises = $block->exercises;
            foreach ($exercises as $exercise) {
                $answers = Answer::where('exercise_id', $exercise->id)->get();
                foreach ($answers as $answer) {
                    if ($answer->mark) {
                        $score += $answer->mark;
                        $i++;
                    }
                }
            }
        }

        if ($i === 0) {
            return 0;
        }
        return round($score / $i, 1);
    }
}
