<?php

declare(strict_types=1);

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public readonly ?int $schoolId = null,
        public readonly ?string $userType = null,
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $photo = null,
        public readonly ?string $status = 'active',
        public readonly ?string $password = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            schoolId: $data['school_id'] ?? null,
            userType: $data['user_type'] ?? null,
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            photo: $data['photo'] ?? null,
            status: $data['status'] ?? 'active',
            password: $data['password'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'school_id' => $this->schoolId,
            'user_type' => $this->userType,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $this->photo,
            'status' => $this->status,
            'password' => $this->password,
        ], fn ($value) => $value !== null);
    }
}
