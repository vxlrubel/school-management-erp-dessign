<?php

namespace App\Repositories;

use App\Models\AlumniEvent;
use Illuminate\Database\Eloquent\Model;

class AlumniEventRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new AlumniEvent;
    }
}
