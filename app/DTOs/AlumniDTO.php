<?php

namespace App\DTOs;

class AlumniDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly int $student_id = 0,
        public readonly ?string $profession = null,
        public readonly ?string $company = null,
        public readonly ?string $batch = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            student_id: $data['student_id'] ?? 0,
            profession: $data['profession'] ?? null,
            company: $data['company'] ?? null,
            batch: $data['batch'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'student_id' => $this->student_id,
            'profession' => $this->profession,
            'company' => $this->company,
            'batch' => $this->batch,
        ];
    }
}
