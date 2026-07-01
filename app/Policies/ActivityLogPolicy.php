<?php

namespace App\Policies;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ActivityLog $activityLog): bool
    {
        return $user->school_id === $activityLog->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ActivityLog $activityLog): bool
    {
        return $user->school_id === $activityLog->school_id;
    }

    public function delete(User $user, ActivityLog $activityLog): bool
    {
        return $user->school_id === $activityLog->school_id;
    }
}
