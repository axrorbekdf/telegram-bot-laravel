<?php

namespace App\Listeners;

use App\Events\OrderStore;
use App\Helpers\Telegram;

class TelegramSubscriber
{

    protected $telegram;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function subscribe($event)
    {
        $event->listen(
            OrderStore::class, [
                TelegramSubscriber::class, 'orderStore',
            ]
        );
    }

    /**
     * Handle the event.
     *
     * @param  OrderStore  $event
     * @return void
     */
    public function orderStore($event){
        $data = [
            'id' => $event->order->id,
            'name' => $event->order->name,
            'email' => $event->order->email,
            'product' => $event->order->product,
        ];

        $button = [
            'inline_keyboard' => [
                [
                    [
                        'text' => "Qabul qilish",
                        'callback_data' => "1|".$event->order->secret_key,
                    ],
                    [
                        'text' => "Bekor qilish",
                        'callback_data' => "0|".$event->order->secret_key,
                    ]
                ]
            ]
        ];

        $sendMessage = $this->telegram->sendButtons(env("REPORT_TELEGRAM_ID"), (string) view('site.messages.new_order', $data), $button);
    }
}
