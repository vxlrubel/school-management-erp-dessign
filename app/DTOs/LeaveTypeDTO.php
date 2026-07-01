<?php

namespace App\DTOs;

class LeaveTypeDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $name,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            name: $data['name'],
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'name' => $this->name,
        ];
    }
}
