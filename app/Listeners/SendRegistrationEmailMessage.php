<?php

namespace App\Listeners;

use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationEmailMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $emailData = [
            'title' => 'Успешная регистрация!',
            'track' => $event->user->tracks[0]['title'],
            'login' => $event->user->login,
        ];
        $mail = Mail::to($event->user->email)->send(new RegistrationMail($emailData));
        dd('asdasda');
    }
}
