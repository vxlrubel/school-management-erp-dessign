<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Transaction $transaction): bool
    {
        return $user->school_id === $transaction->school_id;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::SchoolAdmin;
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return $user->school_id === $transaction->school_id
            && $user->type === UserType::SchoolAdmin;
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->school_id === $transaction->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function restore(User $user, Transaction $transaction): bool
    {
        return $user->school_id === $transaction->school_id
            && ($user->type === UserType::SchoolAdmin || $user->type === UserType::SuperAdmin);
    }

    public function forceDelete(User $user, Transaction $transaction): bool
    {
        return $user->type === UserType::SuperAdmin;
    }
}
