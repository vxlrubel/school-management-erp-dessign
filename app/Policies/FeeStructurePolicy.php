<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\FeeStructure;
use App\Models\User;

class FeeStructurePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, FeeStructure $feeStructure): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin;
    }

    public function update(User $user, FeeStructure $feeStructure): bool
    {
        return $user->type === UserType::SchoolAdmin;
    }

    public function delete(User $user, FeeStructure $feeStructure): bool
    {
        return $user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin;
    }
}
