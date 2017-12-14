<?php

namespace App\Listeners;

use App\Events\ChangeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeListener
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
     * @param  ChangeEvent  $event
     * @return void
     */
    public function handle(ChangeEvent $event)
    {
        //
    }
}
