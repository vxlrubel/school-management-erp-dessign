<?php

namespace App\Repositories;

use App\Models\ExamSubject;

class ExamSubjectRepository extends BaseRepository
{
    protected function resolveModel(): ExamSubject
    {
        return new ExamSubject;
    }
}
