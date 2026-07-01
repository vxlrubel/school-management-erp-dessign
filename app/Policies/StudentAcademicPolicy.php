<?php

namespace App\Policies;

use App\Models\StudentAcademic;
use App\Models\User;

class StudentAcademicPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StudentAcademic $studentAcademic): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, StudentAcademic $studentAcademic): bool
    {
        return true;
    }

    public function delete(User $user, StudentAcademic $studentAcademic): bool
    {
        return true;
    }
}
