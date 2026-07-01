<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Role $role): bool
    {
        return $user->user_type === UserType::SuperAdmin || $user->school_id === $role->school_id;
    }

    public function create(User $user): bool
    {
        return in_array($user->user_type, [UserType::SuperAdmin, UserType::SchoolAdmin]);
    }

    public function update(User $user, Role $role): bool
    {
        return $user->user_type === UserType::SuperAdmin || $user->school_id === $role->school_id;
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->user_type === UserType::SuperAdmin || $user->school_id === $role->school_id;
    }
}
