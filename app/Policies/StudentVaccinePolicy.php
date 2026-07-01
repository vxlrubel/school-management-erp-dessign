<?php

namespace App\Policies;

use App\Models\StudentVaccine;
use App\Models\User;

class StudentVaccinePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StudentVaccine $studentVaccine): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, StudentVaccine $studentVaccine): bool
    {
        return true;
    }

    public function delete(User $user, StudentVaccine $studentVaccine): bool
    {
        return true;
    }
}
