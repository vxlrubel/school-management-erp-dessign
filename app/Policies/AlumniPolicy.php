<?php

namespace App\Policies;

use App\Models\Alumni;
use App\Models\User;

class AlumniPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Alumni $alumni): bool
    {
        return $user->school_id === $alumni->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Alumni $alumni): bool
    {
        return $user->school_id === $alumni->school_id;
    }

    public function delete(User $user, Alumni $alumni): bool
    {
        return $user->school_id === $alumni->school_id;
    }

    public function restore(User $user, Alumni $alumni): bool
    {
        return $user->school_id === $alumni->school_id;
    }

    public function forceDelete(User $user, Alumni $alumni): bool
    {
        return $user->school_id === $alumni->school_id;
    }
}
