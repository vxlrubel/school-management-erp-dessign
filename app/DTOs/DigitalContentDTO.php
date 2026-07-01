<?php

namespace App\DTOs;

class DigitalContentDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly string $title = '',
        public readonly string $file = '',
        public readonly ?int $class_id = null,
        public readonly ?int $subject_id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            title: $data['title'] ?? '',
            file: $data['file'] ?? '',
            class_id: $data['class_id'] ?? null,
            subject_id: $data['subject_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'file' => $this->file,
            'class_id' => $this->class_id,
            'subject_id' => $this->subject_id,
        ];
    }
}
