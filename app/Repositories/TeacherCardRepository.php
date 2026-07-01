<?php

namespace App\Repositories;

use App\Models\TeacherCard;
use Illuminate\Database\Eloquent\Model;

class TeacherCardRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new TeacherCard;
    }
}
