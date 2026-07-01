<?php

namespace App\DTOs;

class AdmissionLotteryDTO
{
    public function __construct(
        public readonly int $application_id,
        public readonly string $result,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            application_id: $data['application_id'],
            result: $data['result'] ?? 'pending',
        );
    }

    public function toArray(): array
    {
        return [
            'application_id' => $this->application_id,
            'result' => $this->result,
        ];
    }
}
