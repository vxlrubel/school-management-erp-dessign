<?php

namespace App\DTOs;

class FeeStructureDTO
{
    public function __construct(
        public readonly int $class_id,
        public readonly int $fee_head_id,
        public readonly float $amount,
    ) {}

    public function toArray(): array
    {
        return [
            'class_id' => $this->class_id,
            'fee_head_id' => $this->fee_head_id,
            'amount' => $this->amount,
        ];
    }
}
