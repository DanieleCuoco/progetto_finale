<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogsUserLogOut
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
    public function handle(Logout $event): void
    {
        {
        Log::info('User logged out', [
            'user_id' => $event->user?->id,
            'email' => $event->user?->email,
            'ip' => request()->ip()
        ]);
        }
    }
}
