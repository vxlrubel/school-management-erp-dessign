<?php

namespace App\DTOs;

class SectionDTO
{
    public function __construct(
        public readonly int $class_id,
        public readonly string $name,
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            class_id: $data['class_id'],
            name: $data['name'],
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'class_id' => $this->class_id,
            'name' => $this->name,
        ];
    }
}
