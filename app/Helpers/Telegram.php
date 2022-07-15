<?php

namespace App\Helpers;

class Telegram
{
    const url = 'https://api.tlgrm.org/bot';

    protected $http;
    protected $bot;
    protected $chat_id;

    public function __construct(Http $http, $bot)
    {
        $this->http = $http;
        $this->bot = $bot;
        $this->chat_id = $this->checkTGid(auth()->user());
    }
    /**
     * Check if in the user exists tg_id
     *
     */
    public function checkTGid($user)
    {
        if (!isset($user->tg_name)) {
            return false;
        }

        // TODO: Сделать проверку юзера по логину

        return true;
    }
    
    public function sendMessage($chat_id, $message)
    {
        return $this->http::post(self::url. $this->bot . '/sendMessage'. [
            'chat_id' => auth()->user()->tg_id,
            'text' => $message ,
            'parse_mode' => 'html',
        ]);
    }
}

