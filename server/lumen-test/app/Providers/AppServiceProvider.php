<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mailer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 追記する-->
        $this->app->singleton('mailer', function ($app) {
            $app->configure('services');
            return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer');
        });
        // 追記する-->
        // $this->app->singleton('mailer', function ($app) {
        //     $app->configure('services');
        //     return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer');
        // });
        // <--追記する
    }
}
