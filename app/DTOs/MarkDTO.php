<?php

namespace App\DTOs;

class MarkDTO
{
    public function __construct(
        public readonly int $exam_subject_id,
        public readonly int $student_id,
        public readonly ?float $marks = null,
        public readonly ?string $grade = null,
    ) {}

    public function toArray(): array
    {
        return [
            'exam_subject_id' => $this->exam_subject_id,
            'student_id' => $this->student_id,
            'marks' => $this->marks,
            'grade' => $this->grade,
        ];
    }
}
