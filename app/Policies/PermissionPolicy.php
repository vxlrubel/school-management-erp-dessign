<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Permission;
use App\Models\User;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Permission $permission): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }
}
