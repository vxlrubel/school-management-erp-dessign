<?php

namespace App\Policies;

use App\Models\AdmissionApplication;
use App\Models\User;

class AdmissionApplicationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AdmissionApplication $admissionApplication): bool
    {
        return $user->school_id === $admissionApplication->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, AdmissionApplication $admissionApplication): bool
    {
        return $user->school_id === $admissionApplication->school_id;
    }

    public function delete(User $user, AdmissionApplication $admissionApplication): bool
    {
        return $user->school_id === $admissionApplication->school_id;
    }
}
