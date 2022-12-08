<?php

namespace App\Models\Admin;

use App\Models\User as ClientUser;


class User extends ClientUser
{
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
