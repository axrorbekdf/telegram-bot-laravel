<?php

namespace App\Providers;

use App\Helpers\Sms;
use App\Helpers\Telegram;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Telegram::class, function($app){
            return new Telegram(new Http());  //, config('tokens.bot')
        });

        $this->app->bind(Sms::class, function($app){
            return new Sms(new Http());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
