<?php

namespace App\Repositories;

use App\Models\Exam;

class ExamRepository extends BaseRepository
{
    protected function resolveModel(): Exam
    {
        return new Exam;
    }
}
