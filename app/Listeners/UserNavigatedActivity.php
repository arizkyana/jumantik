<?php

namespace App\Listeners;

use App\Activity;
use App\Events\UserNavigated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserNavigatedActivity
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
     * @param  UserNavigated  $event
     * @return void
     */
    public function handle(UserNavigated $event)
    {
        Log::info($event->user->email . ' navigated to ' . url()->current());

        $user = $event->user;

        $activity = new Activity();

        $activity->ip = url()->current();
        $activity->id_user = $user->id;
        $activity->message = $user->email . ' navigated to ' . url()->current();

        $activity->save();

    }
}
