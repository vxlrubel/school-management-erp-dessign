<?php

namespace App\Policies;

use App\Models\AlumniEventRegistration;
use App\Models\User;

class AlumniEventRegistrationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AlumniEventRegistration $alumniEventRegistration): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, AlumniEventRegistration $alumniEventRegistration): bool
    {
        return true;
    }

    public function delete(User $user, AlumniEventRegistration $alumniEventRegistration): bool
    {
        return true;
    }
}
