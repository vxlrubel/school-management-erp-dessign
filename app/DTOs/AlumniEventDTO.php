<?php

namespace App\DTOs;

class AlumniEventDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly string $title = '',
        public readonly ?string $description = null,
        public readonly string $event_date = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            title: $data['title'] ?? '',
            description: $data['description'] ?? null,
            event_date: $data['event_date'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'description' => $this->description,
            'event_date' => $this->event_date,
        ];
    }
}
