<?php

namespace App\Models\Admin;

use App\Models\Post as ClientPost;

class Post extends ClientPost
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
