<?php

namespace App\Repositories;

use App\Models\ClassSubject;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new ClassSubject;
    }
}
