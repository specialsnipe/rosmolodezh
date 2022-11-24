<?php

namespace App\Services\AverageMark;

use App\Models\Answer;
use App\Models\Block;

class AverageMarkBlock
{
    public static function getMark(Block $block, &$score = 0, &$countMarks = 0): array
    {
        $exercise = $block->exercises->load('answers');

        foreach ($block->exercises as $exercise) {
            $exerciseData = AverageMarkExercise::getMark($exercise, $score, $countMarks);
            $countMarks += $exerciseData['countMarks'];
            $score += $exerciseData['score'];
        }

        if($countMarks === 0) return BaseAverageMark::getStats();

        return BaseAverageMark::getStats(
            $countMarks,
            $score,
            round($score / $countMarks, 1)
        );
    }
}
