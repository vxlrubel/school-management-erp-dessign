<?php

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;

class NotificationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Notification $notification): bool
    {
        return $user->school_id === $notification->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Notification $notification): bool
    {
        return $user->school_id === $notification->school_id;
    }

    public function delete(User $user, Notification $notification): bool
    {
        return $user->school_id === $notification->school_id;
    }

    public function restore(User $user, Notification $notification): bool
    {
        return $user->school_id === $notification->school_id;
    }

    public function forceDelete(User $user, Notification $notification): bool
    {
        return $user->school_id === $notification->school_id;
    }
}
