<?php

namespace App\Policies;

use App\Models\AlumniEvent;
use App\Models\User;

class AlumniEventPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AlumniEvent $alumniEvent): bool
    {
        return $user->school_id === $alumniEvent->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, AlumniEvent $alumniEvent): bool
    {
        return $user->school_id === $alumniEvent->school_id;
    }

    public function delete(User $user, AlumniEvent $alumniEvent): bool
    {
        return $user->school_id === $alumniEvent->school_id;
    }

    public function restore(User $user, AlumniEvent $alumniEvent): bool
    {
        return $user->school_id === $alumniEvent->school_id;
    }

    public function forceDelete(User $user, AlumniEvent $alumniEvent): bool
    {
        return $user->school_id === $alumniEvent->school_id;
    }
}
