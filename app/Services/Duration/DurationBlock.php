<?php

namespace App\Services\Duration;

use App\Models\Answer;
use App\Models\Block;

class DurationBlock
{
    public static function getDuration(Block $block)
    {
        $exercises = $block->exercises;
        $time = 0;
        foreach ($exercises as $exercise) {
            $time += $exercise->time;
        }

        return round($time / 60);
    }

    public static function getNameDuration(Block $block)
    {
        $newDuration = self::getDuration($block) % 10;
        $duration = self::getDuration($block);
        if ($newDuration === 2 || $newDuration === 3 || $newDuration === 4) {
            return $duration . ' ' . 'часа';
        } elseif ($newDuration === 1 && $newDuration !== 11) {
            return $duration . ' ' . 'час';
        } else {
            return $duration . ' ' . 'часов';
        }
    }
}
