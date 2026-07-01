<?php

namespace App\Policies;

use App\Models\ClassTeacher;
use App\Models\User;

class ClassTeacherPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ClassTeacher $classTeacher): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ClassTeacher $classTeacher): bool
    {
        return true;
    }

    public function delete(User $user, ClassTeacher $classTeacher): bool
    {
        return true;
    }
}
