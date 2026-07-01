<?php

namespace App\DTOs;

class StudentAcademicDTO
{
    public function __construct(
        public readonly int $student_id,
        public readonly int $class_id,
        public readonly int $section_id,
        public readonly int $session_id,
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            student_id: $data['student_id'],
            class_id: $data['class_id'],
            section_id: $data['section_id'],
            session_id: $data['session_id'],
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'section_id' => $this->section_id,
            'session_id' => $this->session_id,
        ];
    }
}
