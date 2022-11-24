<?php

namespace App\Models\Admin;

use App\Models\User as ClientUser;

class User extends ClientUser
{
    public function getRouteKeyName()
    {
        return 'id';
    }
}
