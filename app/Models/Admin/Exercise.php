<?php

namespace App\Models\Admin;

use App\Models\Exercise as ClientExercise;

class Exercise extends ClientExercise
{
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
