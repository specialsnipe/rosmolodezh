<?php

namespace App\Listeners;

use App\Events\UserTelegramUpdate;
use App\Events\TelegramBotSubscribed;

class TelegramSubscriber
{

    public function telegramBotSubscribe($event)
    {
        TelegramLog::create([
            'username' => $event->username,
            'u_id' => $event->id,
            'action' => $event->action
        ]);

        $user = User::where('tg_name', $event->username)->first();
        if(isset($user)) {
            $user->tg_id = $event->id;
            $user->save();
            return true;
        }
        return false;
    }

    public function userTelegramUpdated($event)
    {
        $user = $event->user;

        $tg_data = TelegramLog::where('username', $user->tg_name)->first();
        dd( $tg_data);
        if (isset($tg_data)) {
            $user->tg_name = $tg_data->username;
            $user->save();
            return true;
        }
        return false;
    }

    public function subscribe($events)
    {
        $events->listen(
            UserTelegramUpdate::class,
            [
                TelegramSubscriber::class, 'userTelegramUpdated'
            ]
        );

        $events->listen(
            TelegramBotSubscribed::class,
            [
                TelegramSubscriber::class, 'userTelegramUpdated'
            ]
        );
    }
}
