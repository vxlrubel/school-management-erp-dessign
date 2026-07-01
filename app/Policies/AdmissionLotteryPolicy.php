<?php

namespace App\Policies;

use App\Models\AdmissionLottery;
use App\Models\User;

class AdmissionLotteryPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AdmissionLottery $admissionLottery): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, AdmissionLottery $admissionLottery): bool
    {
        return true;
    }

    public function delete(User $user, AdmissionLottery $admissionLottery): bool
    {
        return true;
    }
}
