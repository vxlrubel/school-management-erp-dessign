<?php

namespace App\DTOs;

class TransactionDTO
{
    public function __construct(
        public readonly int $school_id,
        public readonly string $invoice,
        public readonly float $amount,
        public readonly string $payment_method,
        public readonly string $status,
    ) {}

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'invoice' => $this->invoice,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
        ];
    }
}
