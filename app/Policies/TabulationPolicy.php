<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Tabulation;
use App\Models\User;

class TabulationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tabulation $tabulation): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function update(User $user, Tabulation $tabulation): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::Teacher;
    }

    public function delete(User $user, Tabulation $tabulation): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin;
    }
}
