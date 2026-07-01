<?php

namespace App\DTOs;

class LeaveRequestDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly int $user_id,
        public readonly int $leave_type_id,
        public readonly string $reason,
        public readonly string $start_date,
        public readonly string $end_date,
        public readonly string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            user_id: $data['user_id'],
            leave_type_id: $data['leave_type_id'],
            reason: $data['reason'],
            start_date: $data['start_date'],
            end_date: $data['end_date'],
            status: $data['status'] ?? 'pending',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'user_id' => $this->user_id,
            'leave_type_id' => $this->leave_type_id,
            'reason' => $this->reason,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ];
    }
}
