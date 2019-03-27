<?php

namespace App\Listeners;

use Log;

class UserEventsSubscriber
{

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events -> listen( 
            'Illuminate\Auth\Events\Failed',
            'App\Listeners\UserEventsSubscriber@onLoginFailed'
        );

        $events -> listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventsSubscriber@onLogin'
        );

        $events -> listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventsSubscriber@onLogout'
        );

        $events -> listen(
            'App\Events\UserPasswordChanged',
            'App\Listeners\UserEventsSubscriber@onPasswordChange'
        );
    }

    /**
     * Handle user logout events.
     */
    public function onLoginFailed($event) {
        //Log::info('SUBSCRIBER: User '. auth() -> user() -> username .' login attempt');
        Log::notice('AUTH / login failed / '. $event -> user -> username .' / '. $_SERVER['REMOTE_ADDR'] );
    }

    /**
     * Handle user login events.
     */
    public function onLogin($event) {
        Log::notice('AUTH / login successful / '. $event -> user -> username .' / '. $_SERVER['REMOTE_ADDR'] );
    }

    /**
     * Handle user logout events.
     */
    public function onLogout($event) {
        Log::notice('AUTH / logout successful / '. $event -> user -> username .' / '. $_SERVER['REMOTE_ADDR'] );
    }

    /**
     * Handle user password change events.
     */
    public function onPasswordChange($event) {
        Log::notice('AUTH / password change / '. $event -> user -> username .' / '. $event -> executor -> username .' / '. $_SERVER['REMOTE_ADDR'] );
    }

}
