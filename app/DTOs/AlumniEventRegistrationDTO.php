<?php

namespace App\DTOs;

class AlumniEventRegistrationDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly int $alumni_event_id = 0,
        public readonly int $alumni_id = 0,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            alumni_event_id: $data['alumni_event_id'] ?? 0,
            alumni_id: $data['alumni_id'] ?? 0,
        );
    }

    public function toArray(): array
    {
        return [
            'alumni_event_id' => $this->alumni_event_id,
            'alumni_id' => $this->alumni_id,
        ];
    }
}
