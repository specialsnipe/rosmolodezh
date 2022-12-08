<?php

namespace App\Models\Admin;

use App\Models\Track as ClientTrack;

class Track extends ClientTrack
{

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
