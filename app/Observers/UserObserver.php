<?php

namespace App\Observers;

use App\Models\User;
use Log;

class UserObserver
{
    // -- Listen to the User created event.
    public function created(User $user)
    {
//        Log::emergency($error);
//        Log::alert($error);
//        Log::critical($error);
//        Log::error($error);
//        Log::warning($error);
//        Log::notice($error);
//        Log::info($error);
//        Log::debug($error);
//
        // $user -> name = $user -> name .' / '. time();
        // $user -> save();
    }

    // -- Listen to the User deleting event.
    public function deleting(User $user)
    {
        Log::info('OBSERVER: User #'. $user->username .' deleted!');
    }

    public function hashing(User $user)
    {
        Log::info('OBSERVER: User password hasing');
    }

}
