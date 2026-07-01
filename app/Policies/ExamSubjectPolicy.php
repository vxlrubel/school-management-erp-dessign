<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\ExamSubject;
use App\Models\User;

class ExamSubjectPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ExamSubject $examSubject): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function update(User $user, ExamSubject $examSubject): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function delete(User $user, ExamSubject $examSubject): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin;
    }
}
