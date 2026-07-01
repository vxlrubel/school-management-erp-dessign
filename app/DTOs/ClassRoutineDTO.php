<?php

namespace App\DTOs;

class ClassRoutineDTO
{
    public function __construct(
        public readonly int $class_id,
        public readonly ?int $section_id,
        public readonly string $day,
        public readonly int $period_id,
        public readonly int $subject_id,
        public readonly int $teacher_id,
    ) {}

    public function toArray(): array
    {
        return [
            'class_id' => $this->class_id,
            'section_id' => $this->section_id,
            'day' => $this->day,
            'period_id' => $this->period_id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
        ];
    }
}
