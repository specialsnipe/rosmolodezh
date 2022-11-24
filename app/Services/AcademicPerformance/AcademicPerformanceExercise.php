<?php

namespace App\Services\AcademicPerformance;

use App\Models\Answer;
use App\Models\Exercise;
use Illuminate\Support\Facades\Log;
use App\Services\AcademicPerformance\BasePerformance;

class AcademicPerformanceExercise
{
    public static function getPerformance(Exercise $exercise, $studentCount = 0)
    {
        $countMarks = 0;

        if ($studentCount <= 0) return BasePerformance::getStats();

        foreach ($exercise->answers as $answer) {
            if($answer->mark > 2) $countMarks++;
        }

        return BasePerformance::getStats(
            $studentCount,
            round($countMarks / $studentCount, 2)
        );
    }
}
