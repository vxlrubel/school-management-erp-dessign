<?php

namespace App\DTOs;

class PeriodDTO
{
    public function __construct(
        public readonly int $school_id,
        public readonly string $name,
        public readonly string $start_time,
        public readonly string $end_time,
    ) {}

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'name' => $this->name,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}
