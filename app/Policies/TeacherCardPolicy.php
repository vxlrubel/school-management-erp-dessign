<?php

namespace App\Policies;

use App\Models\TeacherCard;
use App\Models\User;

class TeacherCardPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, TeacherCard $teacherCard): bool
    {
        return $user->school_id === $teacherCard->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, TeacherCard $teacherCard): bool
    {
        return $user->school_id === $teacherCard->school_id;
    }

    public function delete(User $user, TeacherCard $teacherCard): bool
    {
        return $user->school_id === $teacherCard->school_id;
    }
}
