<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Sms{

    protected $http;
    protected $key = "c1e0b309-c629-11ec-a71e-0242ac120002";
    CONST URL = "https://api.smsfly.uz/";

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    public function send($phone, $message){
        return $this->http::post(SELF::URL.'/send', [
            'key' => $this->key,
            'phone' => $phone,
            'message' =>  $message,
        ]);        
    }


    public function sendBulk($phones = [], $message){
        return $this->http::post(SELF::URL.'/send-bulk', [
            'key' => $this->key,
            'message' =>  $message,
            'phones' => $phones,
        ]);        
    }

    public function sendBulkTemplate($message, $phone, $variables)
    {
        return $this->http::post(SELF::URL.'/send-bulk-template', [
            'key' => $this->key,
            'message' =>  $message,
            'messages' => [
                [
                    "phone" => $phone,
                    'variables' => $variables,
                ],
            ],
        ]);
    }

}

?>