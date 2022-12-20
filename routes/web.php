<?php

use App\Helpers\Sms;
use App\Helpers\Telegram;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebHookContorller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Order $order) { 

    return view('site.order', [
        'orders' => $order->active()->get()
    ]);

});

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/webhook', [WebHookContorller::class, 'index']);



// Route::get('/', function (Telegram $telegram) { 

//     $sendMessage = $telegram->sendMessage(env("REPORT_TELEGRAM_ID"), 'Hello World@!');
//     $sendMessage = json_decode($sendMessage);

//     $telegram->sendDocument(env("REPORT_TELEGRAM_ID"), 'logo.png', $sendMessage->result->message_id);

//     $button = [
//         'inline_keyboard' => [
//             [
//                 [
//                     'text' => "Old Button",
//                     'callback_data' => "1",
//                 ]
//             ]
//         ]
//     ];
//     $sendMessage = $telegram->sendButtons(env("REPORT_TELEGRAM_ID"), 'Buttton!', json_encode($button));
//     $sendMessage = json_decode($sendMessage);
//     $button1 = [
//         'inline_keyboard' => [
//             [
//                 [
//                     'text' => "New Button",
//                     'callback_data' => "1",
//                 ]
//             ]
//         ]
//     ];
//     $sendMessage = $telegram->editButtons(env("REPORT_TELEGRAM_ID"), 'New button!', json_encode($button1), $sendMessage->result->message_id);
//     $data = json_decode($sendMessage);

//     dd($data);
// });


// Route::get('/sms', function(Sms $sms){
//     $data = $sms->sendBulkTemplate('Salom do`stim: %name','998905633029',[
//         "name" => "Ahrorbek"
//     ]);

//     dd(json_decode($data));
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
