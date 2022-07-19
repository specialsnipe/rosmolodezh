<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserRegistration;
use Illuminate\Auth\Events\Registered;

class TestController extends Controller
{
    public function test()
    {
        $user = User::find(2);
        event(new UserRegistration($user));
    }
}
