<?php

namespace App\Services\AverageMark;

use App\Models\Exercise;
use App\Services\AverageMark\BaseAverageMark;

class AverageMarkExercise
{

    public static function getMark(Exercise $exercise, &$score = 0, &$countMarks = 0): array
    {
        foreach ($exercise->answers as $answer) {
            if($answer->mark) {
                $score += $answer->mark;
                $countMarks++;
            }
        }
        if ($countMarks <= 0) return BaseAverageMark::getStats();

        return BaseAverageMark::getStats(
            $countMarks,
            $score,
            round($score / $countMarks, 1)
        );
    }
}

