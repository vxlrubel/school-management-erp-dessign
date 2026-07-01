<?php

namespace App\Repositories;

use App\Models\AdmissionApplication;

class AdmissionApplicationRepository extends BaseRepository
{
    protected function resolveModel(): AdmissionApplication
    {
        return new AdmissionApplication;
    }
}
