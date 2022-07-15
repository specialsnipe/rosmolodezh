<?php

namespace App\Listeners;

class TelegramSubscriber
{

    public function userTelegramUpdated($event)
    {
        // TODO: get user tg name and parse it to id then updated the user column "tg_id".
    }

    public function subscribe($events)
    {
        $events->listen(
            UserTelegramUpdate::class,
            [
                TelegramSubscriber::class, 'userTelegramUpdated'
            ]
        );
    }
}
