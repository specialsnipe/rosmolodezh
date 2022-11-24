<?php

namespace App\Models\Admin;

use App\Models\Exercise as ClientExercise;

class Exercise extends ClientExercise
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
