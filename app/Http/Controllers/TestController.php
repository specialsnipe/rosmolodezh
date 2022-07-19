<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function test()
    {
        $user = User::find(1);
        $track = Track::find(1);
        $emailData = [
            'title' => 'Успешная регистрация!',
            'track' => $track->title,
            'login' => $user->login,
        ];

        $mail = Mail::to('idesignerdisk2@gmail.com'/* $data['email'] */)->send(new RegistrationMail($emailData));

        dd($mail, 'success, mb');
    }
}
