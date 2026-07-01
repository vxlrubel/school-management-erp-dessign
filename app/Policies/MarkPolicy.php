<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Mark;
use App\Models\User;

class MarkPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Mark $mark): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function update(User $user, Mark $mark): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function delete(User $user, Mark $mark): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin;
    }
}
