<?php

namespace App\Services\AverageMark;

class BaseAverageMark
{
    public static function getStats($countMarks = 0, $score = 0, $result = 0)
    {
        return [
            "countMarks" => $countMarks,
            "score" => $score,
            "result" => $result,
        ];
    }
}
