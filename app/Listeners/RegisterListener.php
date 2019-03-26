<?php

namespace App\Listeners;

use App\Models\Employer;
use App\Models\Freelancer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterListener
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
     * @param  Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        if ($user->role_id == 3) {
            $data = Freelancer::create([
                'full_name' => $user->name,
                'email' => $user->email,
                'user_id' => $user->id,
                'my' => 0,
            ]);
        } else {
            $name = explode(' ', $user->name);
            $data = Employer::create([
                'user_id' => $user->id,
                'first_name' => $name[0],
                'last_name' => $name[1],
                'email' => $user->email,
            ]);
        }
    }
}
