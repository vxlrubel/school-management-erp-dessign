<?php

namespace App\DTOs;

class SmsLogDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $mobile,
        public readonly string $message,
        public readonly ?string $status,
        public readonly ?string $response,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            mobile: $data['mobile'],
            message: $data['message'],
            status: $data['status'] ?? null,
            response: $data['response'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'mobile' => $this->mobile,
            'message' => $this->message,
            'status' => $this->status,
            'response' => $this->response,
        ];
    }
}
