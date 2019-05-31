<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class LastOnline
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $user = $event->user;
        $user->online_at = date('Y-m-d H:i:s');
        $user->online_ip = $this->request->ip();
        Cache::flush();
        $user->save();
    }
}
