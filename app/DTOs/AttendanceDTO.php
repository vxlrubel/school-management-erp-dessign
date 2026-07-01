<?php

namespace App\DTOs;

use App\Enums\AttendanceType;

class AttendanceDTO
{
    public function __construct(
        public readonly int $school_id,
        public readonly string $attendance_date,
        public readonly AttendanceType $type,
    ) {}

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'attendance_date' => $this->attendance_date,
            'type' => $this->type->value,
        ];
    }
}
