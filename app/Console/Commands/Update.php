<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Redis;
use Telegram\Bot\Laravel\Facades\Telegram;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * @var $update \Telegram\Bot\Objects\Update[]
         */
        $update = Telegram::getUpdates();

        /**
         * @var $message \Telegram\Bot\Objects\Update
         */
        $groups = collect($update)->groupBy('message.chat.id');

        foreach ($groups as $group) {
            $message = $group->last();
            $messageId = $message->getMessage()->getMessageId();
            $messageText = $message->getMessage()->getText();

            $chatId = $message->getMessage()->getChat()->getId();

            if (Redis::get('message' . ':' . $chatId) != $messageId) {
                Redis::set('message' . ':' . $chatId, $messageId);

                if ($messageText == '/start') {
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Приветствую тебя мой повелитель']);
                } else {
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => rand(0, 1000)]);
                }
            }
        }
    }
}
