<?php

namespace App\Listeners;

use App\Mail\RestoredPasswordShipped;
use App\Models\ChangePassword;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendMailWithRestorePassword
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
        $user = $event->user;
        $token = Str::random(20);
        ChangePassword::create([
            'user_id' => $user->id,
            'token'=>$token,
            'expiration_min'=>Carbon::now()->addMinutes(15),
        ]);
        Mail::to($user->email)->send(new RestoredPasswordShipped($user, $token));
    }
}
