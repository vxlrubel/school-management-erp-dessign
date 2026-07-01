<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Period;
use App\Models\User;

class PeriodPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Period $period): bool
    {
        return $user->school_id === $period->school_id;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin;
    }

    public function update(User $user, Period $period): bool
    {
        return $user->school_id === $period->school_id
            && $user->type === UserType::SchoolAdmin;
    }

    public function delete(User $user, Period $period): bool
    {
        return $user->school_id === $period->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function restore(User $user, Period $period): bool
    {
        return $user->school_id === $period->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function forceDelete(User $user, Period $period): bool
    {
        return $user->type === UserType::SuperAdmin;
    }
}
