<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vaccine;

class VaccinePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Vaccine $vaccine): bool
    {
        return $user->school_id === $vaccine->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Vaccine $vaccine): bool
    {
        return $user->school_id === $vaccine->school_id;
    }

    public function delete(User $user, Vaccine $vaccine): bool
    {
        return $user->school_id === $vaccine->school_id;
    }

    public function restore(User $user, Vaccine $vaccine): bool
    {
        return $user->school_id === $vaccine->school_id;
    }

    public function forceDelete(User $user, Vaccine $vaccine): bool
    {
        return $user->school_id === $vaccine->school_id;
    }
}
