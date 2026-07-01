<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\StudentFee;
use App\Models\User;

class StudentFeePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StudentFee $studentFee): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin;
    }

    public function update(User $user, StudentFee $studentFee): bool
    {
        return $user->type === UserType::SchoolAdmin;
    }

    public function delete(User $user, StudentFee $studentFee): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin;
    }
}
