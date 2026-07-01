<?php

namespace App\DTOs;

class NoticeDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $title,
        public readonly string $description,
        public readonly ?string $attachment,
        public readonly string $publish_date,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            title: $data['title'],
            description: $data['description'],
            attachment: $data['attachment'] ?? null,
            publish_date: $data['publish_date'],
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'description' => $this->description,
            'attachment' => $this->attachment,
            'publish_date' => $this->publish_date,
        ];
    }
}
