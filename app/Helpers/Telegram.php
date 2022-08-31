<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Telegram
{
    const url = 'http://api.tlgr.org/bot';

    protected $http;
    protected $bot;
    protected $chat_id;

    public function __construct(Http $http, $bot)
    {
        $this->http = $http;
        $this->bot = $bot;
    }

    public function sendMessage($chat_id, $message)
    {
        return $this->http::post(self::url. $this->bot . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
        ]);
    }
}

