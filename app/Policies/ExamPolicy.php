<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Exam;
use App\Models\User;

class ExamPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Exam $exam): bool
    {
        return $user->school_id === $exam->school_id;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function update(User $user, Exam $exam): bool
    {
        return $user->school_id === $exam->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher);
    }

    public function delete(User $user, Exam $exam): bool
    {
        return $user->school_id === $exam->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function restore(User $user, Exam $exam): bool
    {
        return $user->school_id === $exam->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function forceDelete(User $user, Exam $exam): bool
    {
        return $user->type === UserType::SuperAdmin;
    }
}
