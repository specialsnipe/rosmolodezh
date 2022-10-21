<?php

namespace App\Listeners;

use App\Models\User;
use App\Helpers\Telegram;
use App\Models\TelegramLog;
use App\Events\TestBotMessage;
use App\Events\StartBotMessage;
use App\Events\UserTelegramUpdate;
use Illuminate\Support\Facades\Log;
use App\Events\TelegramBotSubscribed;
use App\Events\AnswerToExerciseSended;
use App\Events\ErrorOnExerciseComplete;
use App\Events\SendMessageAboutMarkSet;

class TelegramSubscriber
{
    public $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function telegramBotSubscribed($event)
    {
        TelegramLog::create([
            'username' => $event->data['username'],
            'u_id' => $event->data['id'],
            'action' => $event->data['action']
        ]);

        $user = User::where('tg_name', $event->data['username'])->first();
        if (isset($user)) {
            $user->update([
                'tg_id' => $event->data['id']
            ]);
            $this->telegram->sendMessage($event->data['id'],
                                        (string)view('telegram.success-connect',
                                        ['username' => $event->data['username']]));


        } else {
            $this->telegram->sendMessage($event->data['id'],
                                        (string)view('telegram.paste-login-on-site',
                                        ['username' => $event->data['username']]));
        }
    }

    public function userTelegramUpdated($event)
    {
        $user = $event->user;
        $new_tg_name = $event->new_tg_name;
        // dd($user->tg_name, $new_tg_name, $user->tg_name != $new_tg_name);

        if($user->tg_name != $new_tg_name) {
            $user->update([
                'tg_name' => $new_tg_name,
                'tg_id' => null,
            ]);
        }


        $tg_data = TelegramLog::where('username', $user->tg_name)->first();
        if (isset($tg_data)) {

            $user->update([
                'tg_id' => $tg_data->u_id
            ]);

            $this->telegram->sendMessage($tg_data->u_id,
                                        (string)view('telegram.success-connect',
                                        ['username' => $user->tg_name]));
        }
    }

    public function startBotMessage($event)
    {
        $message = $this->telegram->sendMessage($event->chat_id, (string)view('telegram.start_bot', ['username' => $event->username]));
        return $message;
    }

    public function testBotMessage($event)
    {
        $message = $this->telegram->sendMessage($event->chat_id, (string)view('telegram.test_message'));
        return $message;
    }

    public function errorOnExerciseComplete($event)
    {
        $message = $this->telegram->sendMessage($event->chat_id, $event->message);
        return $message;
    }
    public function sendMessageAboutMarkSet($event)
    {
        $message = $this->telegram->sendMessage($event->chat_id, $event->message);
        return $message;
    }
    public function answerToExerciseSended($event)
    {
        $message = $this->telegram->sendMessage($event->chat_id, $event->message);
        return $message;
    }

    public function subscribe($events)
    {
        $events->listen(
            UserTelegramUpdate::class, [ TelegramSubscriber::class, 'userTelegramUpdated' ]
        );

        $events->listen(
            TelegramBotSubscribed::class, [ TelegramSubscriber::class, 'telegramBotSubscribed' ]
        );
        $events->listen(
            StartBotMessage::class, [ TelegramSubscriber::class, 'startBotMessage' ]
        );
        $events->listen(
            TestBotMessage::class, [ TelegramSubscriber::class, 'testBotMessage' ]
        );
        $events->listen(
            ErrorOnExerciseComplete::class, [ TelegramSubscriber::class, 'errorOnExerciseComplete' ]
        );
        $events->listen(
            SendMessageAboutMarkSet::class, [ TelegramSubscriber::class, 'sendMessageAboutMarkSet' ]
        );
        $events->listen(
            AnswerToExerciseSended::class, [ TelegramSubscriber::class, 'answerToExerciseSended' ]
        );
    }
}
