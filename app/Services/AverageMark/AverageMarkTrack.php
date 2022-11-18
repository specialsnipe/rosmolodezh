<?php

namespace App\Services\AverageMark;

use App\Models\Track;
use App\Models\Answer;

class AverageMarkTrack
{
    public static function getMark(Track $track)
    {
        $score = 0;
        $markCount = 0;
        $blocks = $track->blocks->load('exercises');
        
        if ($blocks->count() <= 0 ) return $score;

        foreach($blocks as $block) {
            $averageMark = $block->getAverageScoreAttribute();
            if ($averageMark != 0) {
                $score += $averageMark;
                $markCount += 1;
            }
        }

        if ($markCount <= 0 ) return 0;

        return round($score / $markCount, 1);
    }
}
