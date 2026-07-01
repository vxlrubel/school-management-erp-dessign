<?php

namespace App\Repositories;

use App\Models\AdmissionLottery;

class AdmissionLotteryRepository extends BaseRepository
{
    protected function resolveModel(): AdmissionLottery
    {
        return new AdmissionLottery;
    }
}
