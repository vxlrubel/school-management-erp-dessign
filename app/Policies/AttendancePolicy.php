<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Attendance;
use App\Models\User;

class AttendancePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Attendance $attendance): bool
    {
        return $user->school_id === $attendance->school_id;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function update(User $user, Attendance $attendance): bool
    {
        return $user->school_id === $attendance->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher);
    }

    public function delete(User $user, Attendance $attendance): bool
    {
        return $user->school_id === $attendance->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function restore(User $user, Attendance $attendance): bool
    {
        return $user->school_id === $attendance->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function forceDelete(User $user, Attendance $attendance): bool
    {
        return $user->type === UserType::SuperAdmin;
    }
}
