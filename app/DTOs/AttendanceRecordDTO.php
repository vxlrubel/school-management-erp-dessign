<?php

namespace App\DTOs;

use App\Enums\AttendanceStatus;

class AttendanceRecordDTO
{
    public function __construct(
        public readonly int $attendance_id,
        public readonly int $user_id,
        public readonly AttendanceStatus $status,
        public readonly ?float $latitude = null,
        public readonly ?float $longitude = null,
        public readonly ?string $device = null,
    ) {}

    public function toArray(): array
    {
        return [
            'attendance_id' => $this->attendance_id,
            'user_id' => $this->user_id,
            'status' => $this->status->value,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'device' => $this->device,
        ];
    }
}
