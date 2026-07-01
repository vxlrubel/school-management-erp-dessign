<?php

namespace App\Policies;

use App\Models\IdCardTemplate;
use App\Models\User;

class IdCardTemplatePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, IdCardTemplate $idCardTemplate): bool
    {
        return $user->school_id === $idCardTemplate->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, IdCardTemplate $idCardTemplate): bool
    {
        return $user->school_id === $idCardTemplate->school_id;
    }

    public function delete(User $user, IdCardTemplate $idCardTemplate): bool
    {
        return $user->school_id === $idCardTemplate->school_id;
    }

    public function restore(User $user, IdCardTemplate $idCardTemplate): bool
    {
        return $user->school_id === $idCardTemplate->school_id;
    }

    public function forceDelete(User $user, IdCardTemplate $idCardTemplate): bool
    {
        return $user->school_id === $idCardTemplate->school_id;
    }
}
