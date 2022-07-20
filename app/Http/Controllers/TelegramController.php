<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function index(Request $request)
    {
        $all = $request->all();
        if(isset($all['my_chat_member'])) {
            $username = $all['my_chat_member']['chat']['username'];
            $id = $all['my_chat_member']['chat']['id'];
        }

        Log::debug($request->all());

    }
}
