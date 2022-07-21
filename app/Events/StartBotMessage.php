<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StartBotMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat_id;
    public $username;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($chat_id, $username)
    {
        $this->chat_id = $chat_id;
        $this->username = $username;
    }

}
