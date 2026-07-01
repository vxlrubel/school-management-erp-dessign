<?php

namespace App\DTOs;

class FeeHeadDTO
{
    public function __construct(
        public readonly int $school_id,
        public readonly string $name,
    ) {}

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'name' => $this->name,
        ];
    }
}
