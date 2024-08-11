<?php

namespace App\Providers;

use App\Events\SendEmailEvent;
use App\Listeners\SendEmailListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            SendEmailEvent::class,
            SendEmailListener::class,
        );
    }
}
