<?php

namespace App\Listeners;

use App\Activity;
use App\Events\UserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserEventSubscribers
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
     * @param  UserEvent  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        //
    }

    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {
        Log::info('User loggin ' . $event->user->id);
        $activity = new Activity();

        $activity->ip = url()->current();
        $activity->id_user = $event->user->id;
        $activity->message = $event->user->email . ' login to system.';

        // TODO 1: Handle prevent multiple same user login at one session / time

        $activity->save();
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {
        Log::info('User logout ' . $event->user->id);

        $activity = new Activity();

        $activity->ip = url()->current();
        $activity->id_user = $event->user->id;
        $activity->message = $event->user->email . ' logout from system.';

        $activity->save();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscribers@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscribers@onUserLogout'
        );
    }
}
