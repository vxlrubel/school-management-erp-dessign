<?php

namespace App\Repositories;

use App\Models\Alumni;
use Illuminate\Database\Eloquent\Model;

class AlumniRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Alumni;
    }
}
