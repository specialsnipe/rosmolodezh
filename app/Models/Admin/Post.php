<?php

namespace App\Models\Admin;

use App\Models\Post as ClientPost;

class Post extends ClientPost
{
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
