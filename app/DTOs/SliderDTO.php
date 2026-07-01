<?php

namespace App\DTOs;

class SliderDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $title,
        public readonly string $image,
        public readonly ?string $link,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            title: $data['title'],
            image: $data['image'],
            link: $data['link'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'image' => $this->image,
            'link' => $this->link,
        ];
    }
}
