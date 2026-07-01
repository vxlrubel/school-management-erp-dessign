<?php

namespace App\Policies;

use App\Models\CertificateTemplate;
use App\Models\User;

class CertificateTemplatePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, CertificateTemplate $certificateTemplate): bool
    {
        return $user->school_id === $certificateTemplate->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, CertificateTemplate $certificateTemplate): bool
    {
        return $user->school_id === $certificateTemplate->school_id;
    }

    public function delete(User $user, CertificateTemplate $certificateTemplate): bool
    {
        return $user->school_id === $certificateTemplate->school_id;
    }

    public function restore(User $user, CertificateTemplate $certificateTemplate): bool
    {
        return $user->school_id === $certificateTemplate->school_id;
    }

    public function forceDelete(User $user, CertificateTemplate $certificateTemplate): bool
    {
        return $user->school_id === $certificateTemplate->school_id;
    }
}
