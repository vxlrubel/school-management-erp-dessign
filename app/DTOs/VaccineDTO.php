<?php

namespace App\DTOs;

class VaccineDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly string $name = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            name: $data['name'] ?? '',
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
