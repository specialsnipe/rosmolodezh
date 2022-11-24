<?php

namespace App\Services\AcademicPerformance;

class BasePerformance
{
    public static function getStats($studentCount = 0, $performance = 0): array
    {
        return [
            "studentCount" => $studentCount,
            "performance" => $performance,
        ];
    }
}
