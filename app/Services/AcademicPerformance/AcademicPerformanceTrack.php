<?php

namespace App\Services\AcademicPerformance;

use App\Models\Block;
use App\Models\Track;
use App\Models\Answer;
use Illuminate\Support\Facades\Log;
use App\Services\AcademicPerformance\BasePerformance;
use App\Services\AcademicPerformance\AcademicPerformanceBlock;
use App\Services\AcademicPerformance\AcademicPerformanceExercise;

class AcademicPerformanceTrack
{
    public static function getPerformance(Track $track)
    {
        $score = 0;

        $blocks = Block::where('track_id', $track->id)->with('exercises')->get();
        $blocksCount = $blocks->count();
        $studentsCount = $track->studentsCount;

        $performance = 0;
        $midStatPerformance = 0;

        if ($studentsCount <= 0) return BasePerformance::getStats();

        foreach ($blocks as $block) {
            [ "performance" => $tmpPerformance ] = AcademicPerformanceBlock::getPerformance($block);
            $performance += $tmpPerformance;
        }

        if ($blocksCount <= 0) $midStatPerformance = $performance / $blocksCount;

        return BasePerformance::getStats(
            $studentsCount,
            round($midStatPerformance / $studentsCount, 2)
        );

    }
}
