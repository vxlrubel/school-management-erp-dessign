<?php

declare(strict_types=1);

namespace App\DTOs;

class SchoolDTO
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $eiin = null,
        public readonly ?string $logo = null,
        public readonly ?string $favicon = null,
        public readonly ?string $address = null,
        public readonly ?string $phone = null,
        public readonly ?string $email = null,
        public readonly ?string $website = null,
        public readonly ?string $status = 'active',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            eiin: $data['eiin'] ?? null,
            logo: $data['logo'] ?? null,
            favicon: $data['favicon'] ?? null,
            address: $data['address'] ?? null,
            phone: $data['phone'] ?? null,
            email: $data['email'] ?? null,
            website: $data['website'] ?? null,
            status: $data['status'] ?? 'active',
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'eiin' => $this->eiin,
            'logo' => $this->logo,
            'favicon' => $this->favicon,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'status' => $this->status,
        ], fn ($value) => $value !== null);
    }
}
