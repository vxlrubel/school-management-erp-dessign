<?php

namespace App\Policies;

use App\Models\EmployeeCard;
use App\Models\User;

class EmployeeCardPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, EmployeeCard $employeeCard): bool
    {
        return $user->school_id === $employeeCard->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, EmployeeCard $employeeCard): bool
    {
        return $user->school_id === $employeeCard->school_id;
    }

    public function delete(User $user, EmployeeCard $employeeCard): bool
    {
        return $user->school_id === $employeeCard->school_id;
    }
}
