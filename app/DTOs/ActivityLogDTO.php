<?php

namespace App\DTOs;

class ActivityLogDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $user_id = null,
        public readonly ?int $school_id = null,
        public readonly string $module = '',
        public readonly string $action = '',
        public readonly string $ip = '',
        public readonly ?string $device = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            user_id: $data['user_id'] ?? null,
            school_id: $data['school_id'] ?? null,
            module: $data['module'] ?? '',
            action: $data['action'] ?? '',
            ip: $data['ip'] ?? '',
            device: $data['device'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'school_id' => $this->school_id,
            'module' => $this->module,
            'action' => $this->action,
            'ip' => $this->ip,
            'device' => $this->device,
        ];
    }
}
