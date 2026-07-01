<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;

class PagePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Page $page): bool
    {
        return $user->school_id === $page->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Page $page): bool
    {
        return $user->school_id === $page->school_id;
    }

    public function delete(User $user, Page $page): bool
    {
        return $user->school_id === $page->school_id;
    }
}
