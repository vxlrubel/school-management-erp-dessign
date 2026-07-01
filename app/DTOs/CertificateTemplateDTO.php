<?php

namespace App\DTOs;

class CertificateTemplateDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly string $name = '',
        public readonly string $html = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            name: $data['name'] ?? '',
            html: $data['html'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'name' => $this->name,
            'html' => $this->html,
        ];
    }
}
