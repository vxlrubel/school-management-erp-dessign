<?php

declare(strict_types=1);

namespace App\DTOs;

class RoleDTO
{
    public function __construct(
        public readonly ?int $schoolId = null,
        public readonly ?string $name = null,
        public readonly ?string $slug = null,
        public readonly ?string $description = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            schoolId: $data['school_id'] ?? null,
            name: $data['name'] ?? null,
            slug: $data['slug'] ?? null,
            description: $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'school_id' => $this->schoolId,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ], fn ($value) => $value !== null);
    }
}
