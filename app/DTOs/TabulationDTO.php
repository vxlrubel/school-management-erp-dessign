<?php

namespace App\DTOs;

class TabulationDTO
{
    public function __construct(
        public readonly int $exam_id,
        public readonly int $student_id,
        public readonly ?float $gpa = null,
        public readonly ?int $position = null,
    ) {}

    public function toArray(): array
    {
        return [
            'exam_id' => $this->exam_id,
            'student_id' => $this->student_id,
            'gpa' => $this->gpa,
            'position' => $this->position,
        ];
    }
}
