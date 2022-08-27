<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Telegram;
use App\Models\TelegramLog;
use Illuminate\Http\Request;
use App\Events\TestBotMessage;
use App\Events\StartBotMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Events\TelegramBotSubscribed;

class TelegramController extends Controller
{
    public function index(Request $request)
    {
        $all = $request->all();

        if(isset($all['my_chat_member'])) {
            // New user of telegram bot (? may be not ?)
            $username = $all['my_chat_member']['chat']['username'];
            $id = $all['my_chat_member']['chat']['id'];
            $action = $all['my_chat_member']['new_chat_member']['status'];

            $data = [
                'username' => $username,
                'id' => $id,
                'action' => $action
            ];

            event(new TelegramBotSubscribed($data));

        }
        if(isset($all['message'])) {
            // message to bot from user.  Get message through $all['message']['text']

            if(isset($all['message']['entities'][0]) && $all['message']['entities'][0]['type'] == 'bot_command') {

            // some comand from user. Get comand through $all['message']['text']
            }
            $chat_id = $all['message']['chat']['id'];
            $username = $all['message']['chat']['username'];
            $action = $all['message']['text'];
            $data = [
                'username' => $username,
                'id' => $chat_id,
                'action' => $action
            ];
            event(new TelegramBotSubscribed($data));

            switch ($action) {
                case '/start':
                    // Log::debug($action);
                    $message = event(new StartBotMessage($chat_id, $username));
                    break;
                case '/test':
                    // Log::debug($action);
                    $message = event(new TestBotMessage($chat_id));
                    break;
            }
        }

        // Log::debug($request->all());

    }
}
