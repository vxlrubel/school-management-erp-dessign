<?php

namespace App\DTOs;

class ClassTeacherDTO
{
    public function __construct(
        public readonly int $class_id,
        public readonly int $teacher_id,
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            class_id: $data['class_id'],
            teacher_id: $data['teacher_id'],
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'class_id' => $this->class_id,
            'teacher_id' => $this->teacher_id,
        ];
    }
}
