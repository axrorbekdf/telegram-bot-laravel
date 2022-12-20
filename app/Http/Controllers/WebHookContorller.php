<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Helpers\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookContorller extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Telegram $telegram)
    {
         Log::debug($request->input('callback_query'));
         $public = explode('|', $request->input('callback_query')['data'])[0];
         $secret_key = explode('|', $request->input('callback_query')['data'])[1];
         
         $order = Order::where('secret_key', $secret_key)->first();
         
         if($public == 1){
            $button = [
                'inline_keyboard' => [
                    [
                        [
                            'text' => "✅ Qabul qilish",
                            'callback_data' => "1|".$order->secret_key,
                        ],
                        [
                            'text' => "Bekor qilish",
                            'callback_data' => "0|".$order->secret_key,
                        ]
                    ]
                ]
            ];   
         }
         
         if($public == 0){
            $button = [
                'inline_keyboard' => [
                    [
                        [
                            'text' => "Qabul qilish",
                            'callback_data' => "1|".$order->secret_key,
                        ],
                        [
                            'text' => "✅ QBekor qilish",
                            'callback_data' => "0|".$order->secret_key,
                        ]
                    ]
                ]
            ];   
         }
         
         $data = [
            'id' => $order->id,
            'name' => $order->name,
            'email' => $order->email,
            'product' => $order->product,
        ];

        $telegram->editButtons(env("REPORT_TELEGRAM_ID"), (string) view('site.messages.new_order', $data), $button, $request->input('callback_query')['message']['message_id']);
        
         $order->public = $public;
         $order->save();
    }
    
    
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getWebhook(Request $request)
    {
        return response()->json($request);
    }
}
