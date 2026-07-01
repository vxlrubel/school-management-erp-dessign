<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserType;
use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->user_type, [UserType::SuperAdmin, UserType::SchoolAdmin]);
    }

    public function view(User $user, User $model): bool
    {
        return $user->user_type === UserType::SuperAdmin
            || $user->school_id === $model->school_id
            || $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return in_array($user->user_type, [UserType::SuperAdmin, UserType::SchoolAdmin]);
    }

    public function update(User $user, User $model): bool
    {
        return $user->user_type === UserType::SuperAdmin
            || $user->school_id === $model->school_id
            || $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        return $user->user_type === UserType::SuperAdmin
            || ($user->school_id === $model->school_id && $user->id !== $model->id);
    }
}
