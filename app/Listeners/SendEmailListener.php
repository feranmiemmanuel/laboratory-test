<?php

namespace App\Listeners;

use App\Jobs\SendEmailJob;
use App\Events\SendEmailEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendEmailEvent $event): void
    {
        try {
            dispatch(new SendEmailJob($event));
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());
        }
    }
}
