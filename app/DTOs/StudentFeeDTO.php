<?php

namespace App\DTOs;

use App\Enums\PaymentStatus;

class StudentFeeDTO
{
    public function __construct(
        public readonly int $student_id,
        public readonly string $month,
        public readonly float $amount,
        public readonly float $discount = 0,
        public readonly float $fine = 0,
        public readonly float $paid = 0,
        public readonly PaymentStatus $status = PaymentStatus::Unpaid,
    ) {}

    public function toArray(): array
    {
        return [
            'student_id' => $this->student_id,
            'month' => $this->month,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'fine' => $this->fine,
            'paid' => $this->paid,
            'status' => $this->status->value,
        ];
    }
}
