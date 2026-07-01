<?php

namespace App\DTOs;

class SessionDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $name,
        public readonly bool $current = false,
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            name: $data['name'],
            current: $data['current'] ?? false,
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'name' => $this->name,
            'current' => $this->current,
        ];
    }
}
