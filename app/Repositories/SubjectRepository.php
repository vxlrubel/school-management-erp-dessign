<?php

namespace App\Repositories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class SubjectRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Subject;
    }
}
