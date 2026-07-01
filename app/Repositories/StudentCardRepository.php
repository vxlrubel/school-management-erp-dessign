<?php

namespace App\Repositories;

use App\Models\StudentCard;
use Illuminate\Database\Eloquent\Model;

class StudentCardRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new StudentCard;
    }
}
