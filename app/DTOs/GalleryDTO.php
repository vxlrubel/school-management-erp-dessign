<?php

namespace App\DTOs;

class GalleryDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $title,
        public readonly string $image,
        public readonly ?string $category,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            title: $data['title'],
            image: $data['image'],
            category: $data['category'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'image' => $this->image,
            'category' => $this->category,
        ];
    }
}
