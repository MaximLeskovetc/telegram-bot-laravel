<?php

namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;

class BotController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function send()
    {
        $update = Telegram::getUpdates();
        $chatId = $update[0]->getMessage()->getChat()->getId();

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => rand(0, 1000)]);

        return redirect()->back();
    }

    public function update()
    {
        $update = Telegram::getUpdates();

        return response()->json(compact('update'));
    }
}
