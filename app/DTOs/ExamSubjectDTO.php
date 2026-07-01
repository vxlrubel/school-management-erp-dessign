<?php

namespace App\DTOs;

class ExamSubjectDTO
{
    public function __construct(
        public readonly int $exam_id,
        public readonly int $subject_id,
        public readonly float $full_marks,
        public readonly float $pass_marks,
    ) {}

    public function toArray(): array
    {
        return [
            'exam_id' => $this->exam_id,
            'subject_id' => $this->subject_id,
            'full_marks' => $this->full_marks,
            'pass_marks' => $this->pass_marks,
        ];
    }
}
