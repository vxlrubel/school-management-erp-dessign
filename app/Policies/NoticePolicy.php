<?php

namespace App\Policies;

use App\Models\Notice;
use App\Models\User;

class NoticePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Notice $notice): bool
    {
        return $user->school_id === $notice->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Notice $notice): bool
    {
        return $user->school_id === $notice->school_id;
    }

    public function delete(User $user, Notice $notice): bool
    {
        return $user->school_id === $notice->school_id;
    }
}
