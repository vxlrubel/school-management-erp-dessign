<?php

namespace App\Policies;

use App\Models\Session;
use App\Models\User;

class SessionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Session $session): bool
    {
        return $user->school_id === $session->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Session $session): bool
    {
        return $user->school_id === $session->school_id;
    }

    public function delete(User $user, Session $session): bool
    {
        return $user->school_id === $session->school_id;
    }
}
