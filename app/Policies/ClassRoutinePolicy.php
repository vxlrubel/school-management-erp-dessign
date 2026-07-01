<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\ClassRoutine;
use App\Models\User;

class ClassRoutinePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ClassRoutine $classRoutine): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function update(User $user, ClassRoutine $classRoutine): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function delete(User $user, ClassRoutine $classRoutine): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin;
    }
}
