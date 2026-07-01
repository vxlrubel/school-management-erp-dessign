<?php

namespace App\Repositories;

use App\Models\AlumniEventRegistration;
use Illuminate\Database\Eloquent\Model;

class AlumniEventRegistrationRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new AlumniEventRegistration;
    }
}
