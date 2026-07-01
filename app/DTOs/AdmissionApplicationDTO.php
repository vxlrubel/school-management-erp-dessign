<?php

namespace App\DTOs;

class AdmissionApplicationDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $name,
        public readonly string $mobile,
        public readonly ?string $email,
        public readonly ?int $class_id,
        public readonly string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            name: $data['name'],
            mobile: $data['mobile'],
            email: $data['email'] ?? null,
            class_id: $data['class_id'] ?? null,
            status: $data['status'] ?? 'pending',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'class_id' => $this->class_id,
            'status' => $this->status,
        ];
    }
}
