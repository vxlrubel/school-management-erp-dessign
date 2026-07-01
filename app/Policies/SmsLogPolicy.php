<?php

namespace App\Policies;

use App\Models\SmsLog;
use App\Models\User;

class SmsLogPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SmsLog $smsLog): bool
    {
        return $user->school_id === $smsLog->school_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SmsLog $smsLog): bool
    {
        return $user->school_id === $smsLog->school_id;
    }

    public function delete(User $user, SmsLog $smsLog): bool
    {
        return $user->school_id === $smsLog->school_id;
    }
}
