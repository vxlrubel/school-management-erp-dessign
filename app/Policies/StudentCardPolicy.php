<?php

namespace App\Policies;

use App\Models\StudentCard;
use App\Models\User;

class StudentCardPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StudentCard $studentCard): bool
    {
        return $user->school_id === $studentCard->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, StudentCard $studentCard): bool
    {
        return $user->school_id === $studentCard->school_id;
    }

    public function delete(User $user, StudentCard $studentCard): bool
    {
        return $user->school_id === $studentCard->school_id;
    }
}
