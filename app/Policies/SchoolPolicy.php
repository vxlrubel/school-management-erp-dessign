<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserType;
use App\Models\School;
use App\Models\User;

class SchoolPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }

    public function view(User $user, School $school): bool
    {
        return $user->user_type === UserType::SuperAdmin || $user->school_id === $school->id;
    }

    public function create(User $user): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }

    public function update(User $user, School $school): bool
    {
        return $user->user_type === UserType::SuperAdmin || $user->school_id === $school->id;
    }

    public function delete(User $user, School $school): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }

    public function restore(User $user, School $school): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }

    public function forceDelete(User $user, School $school): bool
    {
        return $user->user_type === UserType::SuperAdmin;
    }
}
