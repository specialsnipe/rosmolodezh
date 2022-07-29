<?php

namespace App\Services\AverageMark;

use App\Models\Answer;
use App\Models\Block;

class AverageMarkBlock
{
    public static function getMark(Block $block)
    {
        $score = 0;
        $exercises = $block->exercises;
        $i = 0;

        foreach ($exercises as $exercise) {
            $answers = Answer::where('exercise_id', $exercise->id)->get();
            foreach ($answers as $answer) {
                if($answer->mark) {
                    $score += $answer->mark;
                    $i++;
                }
            }
        }
        if($i === 0) {
            return 0;
        }
        return round($score / $i, 1);
    }
}
