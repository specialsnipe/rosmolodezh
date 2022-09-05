<?php

namespace App\Services\AverageMark;

use App\Models\Answer;

class AverageMarkTrack
{
    public static function getMark($track)
    {
        $score = 0;
        $blocks = $track->blocks->load('exercises');
        $i = 0;
        foreach ($blocks as $block) {
            $exercises = $block->exercises->load('answers');
            foreach ($exercises as $exercise) {
                $answers = $exercise->answers;
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
