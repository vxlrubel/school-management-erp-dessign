<?php

namespace App\Repositories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Model;

class VaccineRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Vaccine;
    }
}
