<?php

namespace App\Models\Admin;

use App\Models\Block as ClientBlock;

class Block extends ClientBlock
{
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
