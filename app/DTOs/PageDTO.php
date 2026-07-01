<?php

namespace App\DTOs;

class PageDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $title,
        public readonly ?string $slug,
        public readonly string $content,
        public readonly string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            title: $data['title'],
            slug: $data['slug'] ?? null,
            content: $data['content'],
            status: $data['status'] ?? 'active',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'status' => $this->status,
        ];
    }
}
