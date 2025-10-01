<?php

namespace App\Observers;

use App\Models\murid;
use App\Models\User;
use App\Models\guru;


class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->role === 'guru') {
            guru::create([
                'user_id' => $user->id,
                'name_guru' => $user->username,
            ]);
        }
        elseif ($user->role === 'murid') {
            murid::create([
                'user_id' => $user->id,
                'name_murid' => $user->username,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
