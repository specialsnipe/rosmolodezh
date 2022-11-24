<?php

namespace App\Models\Admin;

use App\Models\Track as ClientTrack;

class Track extends ClientTrack
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
