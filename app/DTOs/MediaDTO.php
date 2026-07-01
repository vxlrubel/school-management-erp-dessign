<?php

namespace App\DTOs;

class MediaDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly string $disk = '',
        public readonly string $file_name = '',
        public readonly string $path = '',
        public readonly string $mime = '',
        public readonly int $size = 0,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            disk: $data['disk'] ?? '',
            file_name: $data['file_name'] ?? '',
            path: $data['path'] ?? '',
            mime: $data['mime'] ?? '',
            size: $data['size'] ?? 0,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'disk' => $this->disk,
            'file_name' => $this->file_name,
            'path' => $this->path,
            'mime' => $this->mime,
            'size' => $this->size,
        ];
    }
}
