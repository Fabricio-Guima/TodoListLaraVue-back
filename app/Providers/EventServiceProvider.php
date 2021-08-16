<?php

namespace App\Providers;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Listeners\SendForgotPasswordNotification;
use App\Listeners\SendWelcomeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
       UserRegistered::class => [
           SendWelcomeNotification::class,
         
       ],
         ForgotPassword::class => [
             SendForgotPasswordNotification::class
         ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
