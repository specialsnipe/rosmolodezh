<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTelegramUpdate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $new_tg_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $new_tg_name)
    {
        $this->user = $user;
        $this->new_tg_name = $new_tg_name;
    }
}
