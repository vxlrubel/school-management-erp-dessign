<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\AttendanceRecord;
use App\Models\User;

class AttendanceRecordPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AttendanceRecord $attendanceRecord): bool
    {
        return $user->school_id === $attendanceRecord->attendance->school_id;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function update(User $user, AttendanceRecord $attendanceRecord): bool
    {
        return $user->school_id === $attendanceRecord->attendance->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher);
    }

    public function delete(User $user, AttendanceRecord $attendanceRecord): bool
    {
        return $user->school_id === $attendanceRecord->attendance->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }
}
