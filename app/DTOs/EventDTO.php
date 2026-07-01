<?php

namespace App\DTOs;

class EventDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $title,
        public readonly string $start_date,
        public readonly string $end_date,
        public readonly ?string $description,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            title: $data['title'],
            start_date: $data['start_date'],
            end_date: $data['end_date'],
            description: $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
        ];
    }
}
