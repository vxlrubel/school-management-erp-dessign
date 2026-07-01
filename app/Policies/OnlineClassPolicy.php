<?php

namespace App\Policies;

use App\Models\OnlineClass;
use App\Models\User;

class OnlineClassPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, OnlineClass $onlineClass): bool
    {
        return $user->school_id === $onlineClass->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, OnlineClass $onlineClass): bool
    {
        return $user->school_id === $onlineClass->school_id;
    }

    public function delete(User $user, OnlineClass $onlineClass): bool
    {
        return $user->school_id === $onlineClass->school_id;
    }

    public function restore(User $user, OnlineClass $onlineClass): bool
    {
        return $user->school_id === $onlineClass->school_id;
    }

    public function forceDelete(User $user, OnlineClass $onlineClass): bool
    {
        return $user->school_id === $onlineClass->school_id;
    }
}
