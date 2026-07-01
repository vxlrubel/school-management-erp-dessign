<?php

namespace App\DTOs;

class OnlineClassDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly string $title = '',
        public readonly string $meeting_url = '',
        public readonly int $teacher_id = 0,
        public readonly string $start_time = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            title: $data['title'] ?? '',
            meeting_url: $data['meeting_url'] ?? '',
            teacher_id: $data['teacher_id'] ?? 0,
            start_time: $data['start_time'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'meeting_url' => $this->meeting_url,
            'teacher_id' => $this->teacher_id,
            'start_time' => $this->start_time,
        ];
    }
}
