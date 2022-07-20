<?php

namespace App\Http\Controllers;

use App\Models\TelegramLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function index(Request $request)
    {
        $all = $request->all();
        if(isset($all['my_chat_member'])) {
            // New user of telegram bot (?)
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
            $chat_id = $all['message']['chat'][id];

            if(isset($all['message']['entities'][0]) && $all['message']['entities'][0]['type'] == 'bot_command') {
                // some comand from user. Get comand through $all['message']['text']
            }
        }

        Log::debug($request->all());

    }
}
