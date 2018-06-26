<?php

namespace App\Listeners;

use App\Events\MorssCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMorssCreatedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MorssCreated  $event
     * @return void
     */
    public function handle(MorssCreated $event)
    {
        //
    }

    public function failed(MorssCreated $event, $exception)
    {
        //
    }
}
