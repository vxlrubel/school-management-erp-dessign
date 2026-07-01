<?php

namespace App\DTOs;

class NotificationDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly string $title = '',
        public readonly string $message = '',
        public readonly string $type = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            title: $data['title'] ?? '',
            message: $data['message'] ?? '',
            type: $data['type'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}
