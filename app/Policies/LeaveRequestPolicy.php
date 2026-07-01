<?php

namespace App\Policies;

use App\Models\LeaveRequest;
use App\Models\User;

class LeaveRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->school_id === $leaveRequest->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->school_id === $leaveRequest->school_id;
    }

    public function delete(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->school_id === $leaveRequest->school_id;
    }
}
