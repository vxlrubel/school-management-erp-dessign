<?php

namespace App\Policies;

use App\Models\StudentGuardian;
use App\Models\User;

class StudentGuardianPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StudentGuardian $studentGuardian): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, StudentGuardian $studentGuardian): bool
    {
        return true;
    }

    public function delete(User $user, StudentGuardian $studentGuardian): bool
    {
        return true;
    }
}
