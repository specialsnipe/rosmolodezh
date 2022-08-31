<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ErrorOnExerciseComplete
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat_id;
    public $message;
    /**
     * Create a new event instance.
     *
     * @param int $user
     * @param string $message
     * @return void
     */
    public function __construct(int $chat_id, string $message)
    {
        $this->chat_id = $chat_id;
        $this->message = $message;
    }
}
