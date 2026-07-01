<?php

namespace App\Policies;

use App\Models\DigitalContent;
use App\Models\User;

class DigitalContentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DigitalContent $digitalContent): bool
    {
        return $user->school_id === $digitalContent->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, DigitalContent $digitalContent): bool
    {
        return $user->school_id === $digitalContent->school_id;
    }

    public function delete(User $user, DigitalContent $digitalContent): bool
    {
        return $user->school_id === $digitalContent->school_id;
    }

    public function restore(User $user, DigitalContent $digitalContent): bool
    {
        return $user->school_id === $digitalContent->school_id;
    }

    public function forceDelete(User $user, DigitalContent $digitalContent): bool
    {
        return $user->school_id === $digitalContent->school_id;
    }
}
