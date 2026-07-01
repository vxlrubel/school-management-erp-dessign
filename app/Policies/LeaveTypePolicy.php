<?php

namespace App\Policies;

use App\Models\LeaveType;
use App\Models\User;

class LeaveTypePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, LeaveType $leaveType): bool
    {
        return $user->school_id === $leaveType->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, LeaveType $leaveType): bool
    {
        return $user->school_id === $leaveType->school_id;
    }

    public function delete(User $user, LeaveType $leaveType): bool
    {
        return $user->school_id === $leaveType->school_id;
    }
}
