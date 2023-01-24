<?php

namespace App\Services\AcademicPerformance;

use App\Models\Block;
use App\Models\Answer;
use App\Models\Exercise;
use Illuminate\Support\Facades\Log;
use App\Services\AcademicPerformance\BasePerformance;
use App\Services\AcademicPerformance\AcademicPerformanceExercise;

class AcademicPerformanceBlock
{
    public static function getPerformance(Block $block)
    {
        [$score, $performance] = [0, 0];

        $exercises = Exercise::where('block_id', $block->id)->with('answers')->get();
        $exercisesCount = $exercises->count();

        $studentsCount = $block->track->users_count;

        $data = [];
        foreach ($exercises as $exercise) {
            [ "performance" => $tmpPerformance ] = AcademicPerformanceExercise::getPerformance($exercise, $studentsCount);
            $performance += $tmpPerformance;
        }

        if ($studentsCount <= 0) return BasePerformance::getStats();

        if ($exercisesCount == 0) {
            return BasePerformance::getStats($studentsCount);
        }

        return BasePerformance::getStats(
            $studentsCount,
            round($performance / $exercisesCount, 2)
        );
    }
}
