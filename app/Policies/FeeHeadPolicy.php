<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\FeeHead;
use App\Models\User;

class FeeHeadPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, FeeHead $feeHead): bool
    {
        return $user->school_id === $feeHead->school_id;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin;
    }

    public function update(User $user, FeeHead $feeHead): bool
    {
        return $user->school_id === $feeHead->school_id
            && $user->type === UserType::SchoolAdmin;
    }

    public function delete(User $user, FeeHead $feeHead): bool
    {
        return $user->school_id === $feeHead->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function restore(User $user, FeeHead $feeHead): bool
    {
        return $user->school_id === $feeHead->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function forceDelete(User $user, FeeHead $feeHead): bool
    {
        return $user->type === UserType::SuperAdmin;
    }
}
