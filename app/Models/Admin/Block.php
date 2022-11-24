<?php

namespace App\Models\Admin;

use App\Models\Block as ClientBlock;

class Block extends ClientBlock
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
